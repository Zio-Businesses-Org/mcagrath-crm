<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\User;
use App\Helper\Reply;
use App\Models\Product;
use App\Enums\Salutation;
use App\Models\LeadAgent;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\Locations; 
use App\Models\StatusLead;
use App\Imports\LeadImport;
use App\Jobs\ImportLeadJob;
use App\Models\CompanyType;
use App\Traits\ImportExcel;
use App\Models\LeadCategory;
use App\Models\LeadPipeline;
use Illuminate\Http\Request;
use App\Models\PipelineStage;
use App\Models\LeadCustomForm;
use App\Models\ClientLeadCustomFilter;
use App\DataTables\DealsDataTable;
use Illuminate\Support\Facades\Log;
use App\DataTables\LeadNotesDataTable;
use App\DataTables\LeadContactDataTable;
use App\Http\Requests\Lead\StoreRequest;
use App\Http\Requests\Lead\UpdateRequest;
use App\Http\Controllers\AccountBaseController;
use App\Http\Requests\Admin\Employee\ImportRequest;
use App\Http\Requests\Admin\Employee\ImportProcessRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LeadClientImport;

class LeadContactController extends AccountBaseController
{

    use ImportExcel;

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'modules.leadContact.leadContacts';
        $this->middleware(function ($request, $next) {
            abort_403(!in_array('leads', $this->user->modules));

            return $next($request);
        });
    }


    public function index(LeadContactDataTable $dataTable)
    {
        $this->viewLeadPermission = $viewPermission = user()->permission('view_lead');

        abort_403(!in_array($viewPermission, ['all']));

        if (!request()->ajax()) {
            $this->clientFilter = ClientLeadCustomFilter::where('user_id', user()->id)->get();
            $this->allEmployees = User::allEmployees(null, null, 'all');
            $this->statusLeads = StatusLead::all();
            $this->companyTypes = CompanyType::all();
        }

        return $dataTable->render('lead-contact.index', $this->data);

    }

    public function show($id)
    {
        $this->leadContact = Lead::findOrFail($id)->withCustomFields();

        $this->viewPermission = user()->permission('view_lead');

        abort_403(!($this->viewPermission == 'all'));

        $this->pageTitle = $this->leadContact->client_name_salutation;

        $this->categories = LeadCategory::all();

        $this->leadFormFields = LeadCustomForm::with('customField')->where('status', 'active')->where('custom_fields_id', '!=', 'null')->get();

        $this->leadId = $id;

        if ($this->leadContact->getCustomFieldGroupsWithFields()) {
            $this->fields = $this->leadContact->getCustomFieldGroupsWithFields()->fields;
        }

        $this->deleteLeadPermission = user()->permission('delete_lead');

        $tab = request('tab');

        switch ($tab) {
        case 'deal':
            return $this->deals();
        case 'notes':
            return $this->notes();
        default:
            $this->view = 'lead-contact.ajax.profile';
            break;
        }

        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }

        $this->activeTab = $tab ?: 'profile';

        return view('lead-contact.show', $this->data);

    }

    public function notes()
    {
        $dataTable = new LeadNotesDataTable();
        $viewPermission = user()->permission('view_deals');

        abort_403(!($viewPermission == 'all' || $viewPermission == 'added' || $viewPermission == 'both'));

        $tab = request('tab');
        $this->activeTab = $tab ?: 'profile';

        $this->view = 'lead-contact.ajax.notes';

        return $dataTable->render('lead-contact.show', $this->data);
    }

    public function deals()
    {
        $viewPermission = user()->permission('view_deals');

        abort_403(!in_array($viewPermission, ['all', 'added', 'both', 'owned']));

        $tab = request('tab');
        $this->pipelines = LeadPipeline::all();

        $defaultPipeline = $this->pipelines->filter(function ($value, $key) {
            return $value->default == 1;
        })->first();

        $this->stages = PipelineStage::where('lead_pipeline_id', $defaultPipeline->id)->get();

        $this->activeTab = $tab ?: 'profile';
        $this->view = 'lead-contact.ajax.deal';
        $dataTable = new DealsDataTable();

        return $dataTable->render('lead-contact.show', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        $this->pageTitle = __('modules.leadContact.createTitle');

        $this->addPermission = user()->permission('add_lead');
        abort_403(!in_array($this->addPermission, ['all', 'added']));



        if ($this->addPermission == 'all') {
            $this->employees = User::allEmployees();
        }

        $defaultStatus = LeadStatus::where('default', '1')->first();
        $this->columnId = ((request('column_id') != '') ? request('column_id') : $defaultStatus->id);
        $this->leadAgents = LeadAgent::with('user')->whereHas('user', function ($q) {
            $q->where('status', 'active');
        })->get();

        $this->leadAgentArray = $this->leadAgents->pluck('user_id')->toArray();

        if ((in_array(user()->id, $this->leadAgentArray))) {
            $this->myAgentId = $this->leadAgents->filter(function ($value, $key) {
                return $value->user_id == user()->id;
            })->first()->id;
        }

        $leadContact = new Lead();

        if ($leadContact->getCustomFieldGroupsWithFields()) {
            $this->fields = $leadContact->getCustomFieldGroupsWithFields()->fields;
        }

        // Fetch states for the dropdown
        $this->states = Locations::select('state')->distinct()->get();

        // Fetch counties for the dropdown
        $this->counties = Locations::select('county')->distinct()->get();

        $this->products = Product::all();
        $this->sources = LeadSource::all();
        $this->status = LeadStatus::all();
        $this->categories = LeadCategory::all();
       // $this->countries = countries();
        //$this->salutations = Salutation::cases();
        $this->statusLeads = StatusLead::all();//newly added status
        $this->companyTypes =CompanyType::all();
        
        $this->view = 'lead-contact.ajax.create';

        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }

        return view('lead-contact.create', $this->data);
      
    }

    /**
     * @param StoreRequest $request
     * @return array|void
     * @throws \Froiden\RestAPI\Exceptions\RelatedResourceNotFoundException
     */
    public function store(StoreRequest $request)
    {
        $this->addPermission = user()->permission('add_lead');

        abort_403(!in_array($this->addPermission, ['all', 'added']));

        $existingUser = User::select('id')
            ->whereHas('roles', function ($q) {
                $q->where('name', 'client');
        })->where('company_id', company()->id)
        ->where('email', $request->client_email)
        ->whereNotNull('email')
        ->first();

        $leadContact = new Lead();
        $leadContact->company_id = company()->id;
        //$leadContact->salutation = $request->salutation;
        $leadContact->client_name = $request->client_name;
        $leadContact->client_email = $request->client_email;
        $leadContact->note = trim_editor($request->note);
        $leadContact->source_id = $request->source_id;
        $leadContact->client_id = $existingUser?->id;
        $leadContact->company_name = $request->company_name;
        $leadContact->company_type = $request->company_type;  // Save company type name
        $leadContact->website = $request->website;
        $leadContact->address = $request->address;
        $leadContact->cell = $request->cell;
        $leadContact->office = $request->office;
        //$leadContact->city = $request->city; 
        $leadContact->state = $request->state;
        //$leadContact->county = $request->county;
        $leadContact->postal_code = $request->postal_code;
        $leadContact->mobile = $request->mobile;
         // Add new fields
        $leadContact->position = $request->position;
        $leadContact->poc = $request->poc;
        $leadContact->last_called_date = $request->last_called_date ? companyToYmd($request->last_called_date) : null;
        $leadContact->next_follow_up_date = $request->next_follow_up_date ? companyToYmd($request->next_follow_up_date) : null;
        //$leadContact->on_board_date = $request->on_board_date ? Carbon::parse($request->on_board_date)->format('Y-m-d') : null;
        //$leadContact->rejected_date = $request->rejected_date ? Carbon::parse($request->rejected_date)->format('Y-m-d') : null;
        $leadContact->comments = $request->comments !== null ? trim_editor($request->comments) : null;
        $leadContact->status_type = $request->status_type; 

        $leadContact->save();

        // To add custom fields data
        if ($request->custom_fields_data) {
            $leadContact->updateCustomFieldData($request->custom_fields_data);
        }

        // Log search
        $this->logSearchEntry($leadContact->id, $leadContact->client_name, 'lead-contact.show', 'lead');

        if ($leadContact->client_email) {
            $this->logSearchEntry($leadContact->id, $leadContact->client_name, 'lead-contact.show', 'lead');
        }

        $redirectUrl = urldecode($request->redirect_url);

        if ($request->add_more == 'true') {
            $html = $this->create();

            return Reply::successWithData(__('messages.recordSaved'), ['html' => $html, 'add_more' => true]);
        }

        if ($redirectUrl == '') {
            $redirectUrl = route('lead-contact.index');
        }

        return Reply::successWithData(__('messages.recordSaved'), ['redirectUrl' => $redirectUrl]);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->leadContact = Lead::with('leadSource', 'category')->findOrFail($id)->withCustomFields();

        $this->editPermission = user()->permission('edit_lead');

        abort_403(!($this->editPermission == 'all'
            || ($this->editPermission == 'added' && $this->leadContact->added_by == user()->id)
            || ($this->editPermission == 'owned' && $this->leadContact->added_by == user()->id)
            || ($this->editPermission == 'both' && $this->leadContact->added_by == user()->id)
            || user()->id == $this->leadContact->added_by)
        );

        $this->leadAgents = LeadAgent::with('user')->whereHas('user', function ($q) {
            $q->where('status', 'active');
        })->get();

        if ($this->leadContact->getCustomFieldGroupsWithFields()) {
            $this->fields = $this->leadContact->getCustomFieldGroupsWithFields()->fields;
        }

        $this->sources = LeadSource::all();
        $this->categories = LeadCategory::all();
        $this->countries = countries();
        $this->statusLeads = StatusLead::all();
         // Fetch counties and states for the dropdowns
       // $this->counties = Locations::select('county')->distinct()->get();
        $this->states = Locations::select('state')->distinct()->get();
       // $this->cities = Locations::select('city')->distinct()->get(); // Ensure cities are fetched
       $this->companyTypes = CompanyType::all(); // Ensure company types are fetched

       // Format dates for the view
        // $this->selectedStatus = $this->leadContact->statusLead ? $this->leadContact->statusLead->id : null;
        $this->leadContact->last_called_date = $this->leadContact->last_called_date ? Carbon::createFromFormat('Y-m-d', $this->leadContact->last_called_date)->format(company()->date_format) : null;
        $this->leadContact->next_follow_up_date = $this->leadContact->next_follow_up_date ? Carbon::createFromFormat('Y-m-d', $this->leadContact->next_follow_up_date)->format(company()->date_format) : null;
        $this->leadContact->on_board_date = $this->leadContact->on_board_date ? Carbon::createFromFormat('Y-m-d', $this->leadContact->on_board_date)->format(company()->date_format) : null;
        $this->leadContact->rejected_date = $this->leadContact->rejected_date ? Carbon::createFromFormat('Y-m-d', $this->leadContact->rejected_date)->format(company()->date_format) : null;
        $this->leadContact->comments = $this->leadContact->comments ?? '';
        $this->pageTitle = __('modules.leadContact.updateTitle');
        $this->salutations = Salutation::cases();

        if (request()->ajax()) {
            $html = view('lead-contact.ajax.edit', $this->data)->render();

            return Reply::dataOnly(['status' => 'success', 'html' => $html, 'title' => $this->pageTitle]);
        }

        $this->view = 'lead-contact.ajax.edit';

        return view('lead-contact.create', $this->data);

    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return array|void
     * @throws \Froiden\RestAPI\Exceptions\RelatedResourceNotFoundException
     */
    public function update(UpdateRequest $request, $id)
    {
        $leadContact = Lead::findOrFail($id);
        $this->editPermission = user()->permission('edit_lead');

        abort_403(!($this->editPermission == 'all'
            || ($this->editPermission == 'added' && $leadContact->added_by == user()->id)
            || ($this->editPermission == 'owned' && $leadContact->added_by == user()->id)
            || ($this->editPermission == 'both' && $leadContact->added_by == user()->id)
            || user()->id == $leadContact->added_by)
        );

        $leadContact->salutation = $request->salutation;
        $leadContact->client_name = $request->client_name;
        $leadContact->client_email = $request->client_email;
        $leadContact->note = trim_editor($request->note);
        $leadContact->source_id = $request->source_id;
        $leadContact->category_id = $request->category_id;
        $leadContact->company_type = $request->company_type; // Update company type name
        $leadContact->website = $request->website;
        $leadContact->address = $request->address;
        $leadContact->cell = $request->cell;
        $leadContact->office = $request->office;
        $leadContact->city = $request->city;
        $leadContact->state = $request->state;
        $leadContact->county = $request->county; 
        $leadContact->postal_code = $request->postal_code;
        $leadContact->mobile = $request->mobile;
        $leadContact->position = $request->position;
        $leadContact->poc = $request->poc;
        // Parse dates in m-d-Y format before saving to the database
        $leadContact->last_called_date = $request->last_called_date ? companyToYmd($request->last_called_date) : null;
        $leadContact->next_follow_up_date = $request->next_follow_up_date ? companyToYmd($request->next_follow_up_date) : null;
        $leadContact->comments = $request->comments !== null ? trim_editor($request->comments) : null;
        $leadContact->status_type = $request->status_type; 
        $leadContact->save();

        // To add custom fields data
        if ($request->custom_fields_data) {
            $leadContact->updateCustomFieldData($request->custom_fields_data);
        }

        return Reply::successWithData(__('messages.updateSuccess'), ['redirectUrl' => route('lead-contact.index')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leadContact = Lead::findOrFail($id);
        $this->deletePermission = user()->permission('delete_lead');

        abort_403(!($this->deletePermission == 'all'
            || ($this->deletePermission == 'added' && $leadContact->added_by == user()->id)
            || ($this->deletePermission == 'owned' && $leadContact->added_by == user()->id)
            || ($this->deletePermission == 'both' && $leadContact->added_by == user()->id)
            || user()->id == $leadContact->added_by)
        );

        Lead::destroy($id);

        return Reply::success(__('messages.deleteSuccess'));

    }

    public function applyQuickAction(Request $request)
    {
        
        switch ($request->action_type) {
            case 'delete':
                Lead::whereIn('id', explode(',', $request->row_ids))->delete();

                return Reply::success(__('messages.deleteSuccess'));

            case 'change-follow-up':
                $items = explode(',', $request->row_ids);
    
                foreach ($items as $item) {
                    
                    $lead = Lead::findOrFail($item);
                    $lead->next_follow_up_date=$request->nxt_follow_up_action == null ? null : companyToYmd($request->nxt_follow_up_action);
                    $lead->save();
                }
    
                return Reply::success(__('messages.updateSuccess'));
            
            case 'change-created-by':
                $items = explode(',', $request->row_ids);
    
                foreach ($items as $item) {
                
                    $lead = Lead::findOrFail($item);
                    $lead->added_by=$request->member;
                    $lead->save();
                }
    
                return Reply::success(__('messages.updateSuccess'));
        }
    }

    public function importLead()
    {
        $this->pageTitle = __('app.importExcel') . ' ' . __('app.menu.lead');

        // $this->addPermission = user()->permission('add_lead');
        // abort_403(!in_array($this->addPermission, ['all', 'added']));

        // if (request()->ajax()) {
        //     $html = view('leads.ajax.import', $this->data)->render();

        //     return Reply::dataOnly(['status' => 'success', 'html' => $html, 'title' => $this->pageTitle]);
        // }

        // $this->view = 'leads.ajax.import';

        return view('leads.ajax.import', $this->data);
    }

    public function importStore(ImportRequest $request)
    {
        // $this->importFileProcess($request, LeadImport::class);

        // $view = view('leads.ajax.import_progress', $this->data)->render();

        // return Reply::successWithData(__('messages.importUploadSuccess'), ['view' => $view]);
        $request->validate([
            'import_file' => 'required'
        ]);

        Excel::import(new LeadClientImport, $request->file('import_file'));

        return Reply::success(__('messages.updateSuccess'));
    }

    public function importProcess(ImportProcessRequest $request)
    {
        $batch = $this->importJobProcess($request, LeadImport::class, ImportLeadJob::class);

        return Reply::successWithData(__('messages.importProcessStart'), ['batch' => $batch]);
    }

}

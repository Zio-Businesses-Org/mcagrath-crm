<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lead\StoreVendorRequest;
use App\Http\Requests\Lead\UpdateVendorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Vendor;
use App\Models\VendorContract;
use App\Helper\Reply;
use App\Models\Project;
use App\Models\ContractType;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use App\DataTables\VendorTrackDataTable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewVendorContract;
use Illuminate\Support\Facades\DB;
use App\Models\LeadSource;
use App\Models\NotesTitle;
use App\Models\Locations;
use App\Models\VendorNotes;
use App\Imports\LeadVendorImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ContractorType;
use App\Models\LeadVendorCustomFilter;
use App\Models\VendorLeadStatus;

class LeadVendorController extends AccountBaseController
{

    public function handle()
    {
        
        $this->pageTitle = __('modules.leadContact.createTitlev');
        $this->view = 'lead-contact.ajax.createvendor';
        $this->contracttype = ContractorType::all();
        $this->leadsource=LeadSource::all();
        $this->notestitle=NotesTitle::all();
        $this->location=Locations::select('state')->distinct()->get();
        $this->vendorStatuses = VendorLeadStatus::all();
        if (request()->ajax()) {
            return $this->returnAjax($this->view);
       
        }

        return view('lead-contact.create', $this->data);
    }
    public function vendorcheck($email)
    {
        $users =Vendor::where('vendor_email', $email)->where('v_status', 'rejected')->exists();
       if($users){
            return Reply::dataOnly(['status' => 'success']);
        }
        else{
            return Reply::dataOnly(['status' => 'failed']);
        }
    }
    public function store(StoreVendorRequest $request)
    {
        $email = $request->input('vendor_email');
        if($request[1]==1)
        {
            try{
                $request->validate([
                    'vendor_email' => 'required',
                ]);
                $leadContact = new Vendor();
                $leadContact->vendor_name = $request->vendor_name;
                $leadContact->poc = $request->poc;
                $leadContact->state = $request->state;
                $leadContact->county = $request->county;
                $leadContact->city = $request->city;
                $leadContact->contractor_type = $request->contractor_type;
                $leadContact->lead_source = $request->lead_source;
                $leadContact->website=$request->website;
                $leadContact->nxt_date=$request->nxt_date == null ? null : companyToYmd($request->nxt_date);
                $leadContact->vendor_email = $request->vendor_email;
                $leadContact->vendor_number = $request->vendor_mobile;
                $leadContact->contract_start=Carbon::today()->format('Y-m-d');
                $leadContact->contract_end=Carbon::today()->addYear()->format('Y-m-d');
                $leadContact->v_status='Proposal Link Sent';
                $leadContact->created_by=user()->name;
                $leadContact->save();
                $vnotes = new VendorNotes();
                $vnotes->vendor_id=$leadContact->id;
                $vnotes->notes_title=$request->notes_title;
                $vnotes->notes_content=$request->notes;
                $vnotes->created_by=user()->name;
                $vnotes->save();
                Notification::route('mail', $email)->notify(new NewVendorContract($leadContact->id));
                $redirectUrl = route('vendortrack.index');
                return Reply::successWithData(__('Saved And Mail Send'), ['redirectUrl' => $redirectUrl]);
            }
            catch (Exception){
                Vendor::destroy($leadContact->id);
                return Reply::error(__('Invalid Email'));
            }
        }
        else{
            $request->validate([
                'v_status' => 'required',
            ]);
            $leadContact = new Vendor();
            $leadContact->vendor_name = $request->vendor_name;
            $leadContact->poc = $request->poc;
            $leadContact->state = $request->state;
            $leadContact->county = $request->county;
            $leadContact->city = $request->city;
            $leadContact->contractor_type = $request->contractor_type;
            $leadContact->lead_source = $request->lead_source;
            $leadContact->website=$request->website;
            $leadContact->nxt_date=$request->nxt_date == null ? null : companyToYmd($request->nxt_date);
            $leadContact->vendor_email = $request->vendor_email;
            $leadContact->vendor_number = $request->vendor_mobile;
            $leadContact->contract_start=Carbon::today()->format('Y-m-d');
            $leadContact->contract_end=Carbon::today()->addYear()->format('Y-m-d');
            $leadContact->v_status=$request->v_status;
            $leadContact->created_by=user()->name;
            $leadContact->save();
            $vnotes = new VendorNotes();
            $vnotes->vendor_id=$leadContact->id;
            $vnotes->notes_title=$request->notes_title;
            $vnotes->notes_content=$request->notes;
            $vnotes->created_by=user()->name;
            $vnotes->save();
            $redirectUrl = route('vendortrack.index');
            return Reply::successWithData(__('Saved'), ['redirectUrl' => $redirectUrl]);
        }
    }
    public function index(VendorTrackDataTable $dataTable)
    {
        $this->pageTitle = 'Vendor Leads';
        if (!request()->ajax()) {
            // $ids = EmployeeDetails::pluck('user_id');
            // $this->subcategories = ClientSubCategory::all();
            // $this->categories = ClientCategory::all();
            // $this->projects = Project::all();
            // $this->contracts = ContractType::all();
            // $this->countries = countries();
            $this->vendorStatuses = VendorLeadStatus::all();
            // $this->createdby = User::whereIn('id', $ids)->get();
            $this->leadVendorFilter = LeadVendorCustomFilter::where('user_id', user()->id)->get();
            $this->contracttype = ContractorType::all();
            $this->state=Locations::select('state')->distinct()->get();
            $this->county=Locations::select('county')->distinct()->get();
            $this->city=Locations::select('city')->distinct()->get();
            $this->allEmployees = User::allEmployees(null, null, 'all');
            $this->leadsource=LeadSource::all();
        }
        return $dataTable->render('vendortrack.index', $this->data);
    }
    public function destroy($id)
    {
        $vendor = Vendor::find($id);

        if ($vendor) {
            $vendor->delete();
        }

        return Reply::success(__('messages.deleteSuccess'));
    }
    public function edit($id)
    {
        $this->contracttype = ContractorType::all();
        $this->vendor = Vendor::where('id', '=', $id)->first();
        $this->pageTitle = __('app.update') . ' ' . __('Vendor Contact Info');
        $this->vendorStatuses = VendorLeadStatus::all();
        $this->leadsource=LeadSource::all(); 
        $this->view = 'vendortrack.ajax.edit';
        $this->location=Locations::select('state')->distinct()->get();
        $this->counties=Locations::select('county')->where('state', $this->vendor->state)->distinct()->get();
        $this->cities=Locations::select('city')->where('county', $this->vendor->county)->distinct()->get();
        $this->leadsource=LeadSource::all();
        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }

        return view('vendortrack.create', $this->data);

    }
    public function update(UpdateVendorRequest $request, $id)
    {
        $v_date = Vendor::find($id);
        DB::table('vendors')
        ->where('id', $id)
        ->update([
        
            'vendor_name' => $request->vendor_name,
            'vendor_email'=>$request->vendor_email,
            'vendor_number'=>$request->vendor_mobile,
            'contract_start'=>Carbon::today()->format('Y-m-d'),
            'contract_end'=>Carbon::today()->addYear()->format('Y-m-d'),
            'v_status'=>$request->v_status,
            'poc' => $request->poc,
            'state' => $request->state,
            'county' => $request->county,
            'city' => $request->city,
            'contractor_type' => $request->contractor_type,
            'lead_source' => $request->lead_source,
            'website' => $request->website,
            'nxt_date' => $request->nxt_date == null ? null : companyToYmd($request->nxt_date),
            'edited_by'=>user()->name,
        ]);
        $redirectUrl = route('vendortrack.index');
        return Reply::successWithData(__('messages.updateSuccess'), ['redirectUrl' => $redirectUrl]);
    }
    public function proposal($id)
    {
        $send_email = Vendor::find($id);
        if($send_email->vendor_email)
        { 
            $send_email->v_status='Proposal Link Sent';
            $send_email->contract_start=Carbon::today()->format('Y-m-d');
            $send_email->contract_end=Carbon::today()->addYear()->format('Y-m-d');
            $send_email->save();
            Notification::route('mail', $send_email->vendor_email)->notify(new NewVendorContract($send_email->id));
            return Reply::success(__('Mail Send'));
        }
        else{
            return Reply::error(__('Email Not Specified.'));
        }
    }
    public function notes($id)
    {
       
        $notes = Vendor::findOrFail($id);
        $this->vendor=Vendor::findOrFail($id);
        $this->view = 'vendortrack.ajax.notes';
        $this->pageTitle = __('Notes');
        $this->note=$notes->notetb;
        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }

        return view('vendortrack.create', $this->data);
    }
    public function notescreate($id)
    {
        $this->notestitle=NotesTitle::all();
        $this->vendor_id=$id;
        return view('vendortrack.create-note-modal', $this->data);
    }
    public function notesstore(Request $request)
    {
            $vnotes = new VendorNotes();
            $vnotes->vendor_id=$request->vendor_id;
            $vnotes->notes_title=$request->notes_title;
            $vnotes->notes_content=$request->notes;
            $vnotes->created_by=user()->name;
            $vnotes->save();
            return Reply::success(__('Saved'));
    }
    public function importLeadVendor()
    {
        return view('vendortrack.import-vendor-lead-modal', $this->data);
    }

    public function importStore(Request $request)
    {
        
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        Excel::import(new LeadVendorImport, $request->file('file'));

        return Reply::success(__('messages.updateSuccess'));
    }

    /**
     * XXXXXXXXXXX
     *
     * @return array
     */
    public function applyQuickAction(Request $request)
    {
        
        switch ($request->action_type) {
        case 'delete':
            $items = explode(',', $request->row_ids);

            foreach ($items as $item) {
                // Delete Vendor Leads
                Vendor::destroy($item);
            }

            return Reply::success(__('messages.deleteSuccess'));
        case 'change-follow-up':
            $items = explode(',', $request->row_ids);

            foreach ($items as $item) {
                
                $vendor = Vendor::findOrFail($item);
                $vendor->nxt_date=$request->nxt_follow_up_action == null ? null : companyToYmd($request->nxt_follow_up_action);
                $vendor->save();
            }

            return Reply::success(__('messages.updateSuccess'));
        
        case 'change-created-by':
            $items = explode(',', $request->row_ids);

            foreach ($items as $item) {
            
                $vendor = Vendor::findOrFail($item);
                $vendor->created_by=$request->member;
                $vendor->save();
            }

            return Reply::success(__('messages.updateSuccess'));

        default:
            return Reply::error(__('messages.selectAction'));
        }
    }
   
}

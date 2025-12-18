<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Reply;
use App\Models\Project;
use App\Models\VendorContract;
use App\Models\ScopeOfWork;
use App\Models\ProjectType;
use App\Models\ContractTemplate;
use App\Models\ProjectVendor;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewVendorWorkOrder;
use App\Http\Requests\Project\StoreProjectVendor;
use Illuminate\Support\Facades\App;
use App\Notifications\ProjectVendorRemoved;
use App\Models\CancelledReason;
use App\Models\VendorWorkOrderStatus;
use App\Models\GlobalSetting;

class ProjectVendorController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.projects';
        $this->middleware(function ($request, $next) {
            abort_403(!in_array('projects', $this->user->modules));

            return $next($request);
        });
    }

    /**
     * XXXXXXXXXXX
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = request('id');

        $this->project = Project::findOrFail($id);
        $this->vendor=VendorContract::all();
        $this->sow=$this->project->sow;
        $this->projecttype=ProjectType::all();
        $this->contract=ContractTemplate::all();
        // $addProjectMilestonePermission = user()->permission('add_project_milestones');
        $project = Project::findOrFail($id);
       // abort_403(!($addProjectMilestonePermission == 'all' || $project->project_admin == user()->id));
        return view('projects.vendors.create', $this->data);
    }
    
    public function store(StoreProjectVendor $request)
    {
        $vwos = VendorWorkOrderStatus::first();
        $vendor = VendorContract::findOrFail($request->vendor_id);
        
        $vendorStatuses = is_array($vwos->vendor_status) ? $vwos->vendor_status : json_decode($vwos->vendor_status, true);
        
        if (in_array($vendor->status, $vendorStatuses)){
            $vpro= new ProjectVendor();
            $vpro->project_id = $request->project_id;
            $vpro->vendor_name=$vendor->vendor_name;
            $vpro->vendor_phone=$vendor->cell;
            $vpro->due_date=companyToYmd($request->due_date);
            $vpro->vendor_email_address=$vendor->vendor_email;
            $vpro->sow_id=$request->sow_id;
            $vpro->vendor_id=$request->vendor_id;
            $vpro->link_sent_by=user()->id;
            $vpro->project_amount=$request->project_amount;
            $vpro->add_notes=$request->add_notes;
            $vpro->project_type=$request->project_vendor_type;
            $vpro->contract_id=$request->contract_id;
            $vpro->link_status='Sent';
            $vpro->save();

            $url = url()->temporarySignedRoute(
                'external.expense.view',
                now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),
                ['pid' => $request->project_id,
                'vid'=>$vpro->id]
            );
        
            $url = getDomainSpecificUrl($url, $this->company);

            $urlext = url()->temporarySignedRoute(
                'external.file.view',
                now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),
                ['data' => $request->project_id]
            );
        
            $urlext = getDomainSpecificUrl($urlext, $this->company);

            $this->logProjectActivity($request->project_id, 'messages.vendorcreated');
            Notification::route('mail', $vendor->vendor_email)->notify(new NewVendorWorkOrder($vpro->id,$request->project_id,$request->contract_id,$request->vendor_id,$url,$urlext));
            return Reply::success(__('New Vendor Added Successfully'));

        }
        else{
            return Reply::error(__('Check Vendor Status'));
        }
        
    }
    public function update(Request $request, $id)
    {
        $vpro = ProjectVendor::findOrFail($id);
        $vpro->project_id = $request->project_id;
        // $vpro->wo_status = $request->wo_status;
        $vpro->inspection_date = $request->inspection_date == null ? null : companyToYmd($request->inspection_date);
        $vpro->inspection_time = $request->inspection_time == null ? null : Carbon::createFromFormat($this->company->time_format, $request->inspection_time)->format('H:i:s');
        $vpro->re_inspection_date = $request->re_inspection_date == null ? null : companyToYmd($request->re_inspection_date);
        $vpro->re_inspection_time = $request->re_inspection_time == null ? null : Carbon::createFromFormat($this->company->time_format, $request->re_inspection_time)->format('H:i:s');
        $vpro->bid_ecd = $request->bid_ecd == null ? null : companyToYmd($request->bid_ecd);
        $vpro->bid_submitted_date = $request->bid_submitted_date == null ? null : companyToYmd($request->bid_submitted_date);
        $vpro->bid_amount = $request->bid_amount;
        $vpro->bid_rejected_date = $request->bid_rejected_date == null ? null : companyToYmd($request->bid_rejected_date);
        $vpro->bid_approval_date = $request->bid_approval_date == null ? null : companyToYmd($request->bid_approval_date);
        $vpro->work_schedule_date = $request->work_schedule_date == null ? null : companyToYmd($request->work_schedule_date);
        $vpro->work_schedule_time = $request->work_schedule_time == null ? null : Carbon::createFromFormat($this->company->time_format, $request->work_schedule_time)->format('H:i:s');
        $vpro->work_schedule_re_date = $request->work_schedule_re_date == null ? null : companyToYmd($request->work_schedule_re_date);
        $vpro->work_schedule_re_time = $request->work_schedule_re_time == null ? null : Carbon::createFromFormat($this->company->time_format, $request->work_schedule_re_time)->format('H:i:s');
        $vpro->work_completion_date = $request->work_completion_date == null ? null : companyToYmd($request->work_completion_date);
        $vpro->work_ecd = $request->work_ecd == null ? null : companyToYmd($request->work_ecd);
        $vpro->bid_approved_amount = $request->bid_approved_amount;
        $vpro->cancelled_date = $request->cancelled_date == null ? null : companyToYmd($request->cancelled_date);
        $vpro->cancelled_reason = $request->cancelled_reason;
        $vpro->invoiced_date = $request->invoiced_date == null ? null : companyToYmd($request->invoiced_date);
        $vpro->invoiced_amount = $request->invoiced_amount;
        $vpro->paid_date = $request->paid_date == null ? null : companyToYmd($request->paid_date);
        $vpro->paid_amount = $request->paid_amount;
        $vpro->save();
        $this->logProjectActivity($request->project_id, 'messages.vendorupdated');

        return Reply::success(__('Vendor Updated'));
    }
    public function destroy($id)
    {
        $vpro = ProjectVendor::findOrFail($id);

        ProjectVendor::destroy($id);
        $this->logProjectActivity($vpro->project_id, 'messages.vprodeleted');

        return Reply::success(__('messages.deleteSuccess'));
    }
    public function download($id)
    {
        $this->pageTitle = 'app.menu.contracts';
        $this->pageIcon = 'fa fa-file';
        $this->company = Company::find(1);
        $this->projectvendor = ProjectVendor::findOrFail($id);
        $this->projectid = Project::findOrFail($this->projectvendor->project_id);
        $this->contractid = ContractTemplate::findOrFail($this->projectvendor->contract_id);
        $this->vendorid = VendorContract::findOrFail($this->projectvendor->vendor_id);

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" fill="red"/></svg>';
        $base64Svg = base64_encode($svg);
        $this->base64StringTimes = "data:image/svg+xml;base64," . $base64Svg;

        $svgCheck = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" fill="green"/></svg>';
        $base64SvgCheck = base64_encode($svgCheck);
        $this->base64StringCheck = "data:image/svg+xml;base64," . $base64SvgCheck;

        $pdf = app('dompdf.wrapper');

        $pdf->setOption('enable_php', true);
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        App::setLocale('en');
        Carbon::setLocale('en');
        $pdf->loadView('projects.vendors.contract-pdf', $this->data);

        $filename = 'contract-' . $this->projectvendor->id;

        return $pdf->download($filename . '.pdf');
    }
    public function linkstatuschange(Request $request, $id)
    {
        $vpro = ProjectVendor::findOrFail($id);
        if($vpro->link_status!==$request->value)
        {
            $this->logProjectActivityDetailed($vpro->project_id, "Link Status Changed for {$vpro->vendor_name}", user()->name, $vpro->link_status, $request->value);
        }
        $vpro->link_status=$request->value;
        if($request->value=='Removed'){
            Notification::route('mail', $vpro->vendor_email_address)->notify(new ProjectVendorRemoved($vpro->id));
        }
        $vpro->save();
        
        return Reply::success(__('Updated Successfully'));
    }
    public function wostatuschange(Request $request, $id)
    {
        $vpro = ProjectVendor::findOrFail($id);
        if($vpro->wo_status!==$request->value)
        {
            $this->logProjectActivityDetailed($vpro->project_id, "Vendor WO Status Change for {$vpro->vendor_name}", user()->name, $vpro->wo_status, $request->value);
        }
        $vpro->wo_status=$request->value;
        $vpro->save();
        
        return Reply::success(__('Updated Successfully'));
    }
    public function resentLink($id)
    {
        $vpro = ProjectVendor::findOrFail($id);
        
        if($vpro->accepted_date)
        {
            $vpro->accepted_date=null;
        }
        if($vpro->rejected_date)
        {
            $vpro->rejected_date=null;
        }
        $vpro->link_status='Sent';
        $vpro->save();
        $url = url()->temporarySignedRoute(
            'external.expense.view',
            now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),
            ['pid' => $vpro->project_id,
            'vid'=>$vpro->id]
        );
    
        $url = getDomainSpecificUrl($url, $this->company);

        $urlext = url()->temporarySignedRoute(
            'external.file.view',
            now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),
            ['data' => $vpro->project_id]
        );
    
        $urlext = getDomainSpecificUrl($urlext, $this->company);
        Notification::route('mail', $vpro->vendor_email_address)->notify(new NewVendorWorkOrder($vpro->id,$vpro->project_id,$vpro->contract_id,$vpro->vendor_id,$url,$urlext));
        return Reply::success(__('Link Resend'));
    }

    public function changenotification($id)
    {
        $this->projectvendor=ProjectVendor::findOrFail($id);
        $this->project = Project::findOrFail($this->projectvendor->project_id);
        $this->sow=$this->project->sow;
        $this->projecttype=ProjectType::all();
        $this->contract=ContractTemplate::all();
        return view('projects.vendors.changenotification', $this->data);
    }

    public function changenotificationhistory($id)
    {
        $this->projectvendor=ProjectVendor::findOrFail($id);
        return view('projects.vendors.changenotificationhistory', $this->data);
    }

    public function getVendorDetails($vendorId, $projectId)
    {
        $projectVendor = ProjectVendor::where('id', $vendorId)
            ->where('project_id', $projectId)
            ->first();
    
        if (!$projectVendor) {
            return response()->json(['status' => 'error', 'message' => 'Vendor details not found']);
        }
    
        // Calculate Change Order Amount
        $changeOrderAmounts = number_format(
            $projectVendor->changenotification
                ->where('link_status', 'Accepted')
                ->whereNotNull('accepted_date')
                ->pluck('project_amount')
                ->map(fn($amount) => (float) $amount)
                ->sum(), 
            2, '.', ''
        );
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'link_status' => $projectVendor->link_status,
                'wo_status' => $projectVendor->wo_status,
                'bid_approved_amount' => $projectVendor->bid_approved_amount,
                'change_order_amount' => $changeOrderAmounts,
                'project_amount'=> $projectVendor->project_amount,
                'invoiced_amount'=> $projectVendor->invoiced_amount
            ]
        ]);
        
    }
    

}

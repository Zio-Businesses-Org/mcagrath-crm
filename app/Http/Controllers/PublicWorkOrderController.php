<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Crypt;
use App\Models\ProjectVendor;
use App\Models\Project;
use App\Models\ContractTemplate;
use App\Models\VendorContract;
use App\Models\ScopeOfWork;
use App\Helper\Reply;
use App\Models\VendorChangeNotification;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WorkOrderAcceptNotification;
use App\Jobs\ProcessWorkOrder;
use App\Models\ProjectFile;
use App\Helper\Files;
use Illuminate\Http\UploadedFile;
use App\Models\GlobalSetting;

class PublicWorkOrderController extends Controller
{
    public function fromEncryptedString($value)
    {
            return Crypt::decryptString($value);
    }

    public function WoView(Request $request){
        $pageTitle = 'app.menu.contracts';
        $pageIcon = 'fa fa-file';
        $company = Company::find(1);
        try {
            $encryptedData = $request->query('data');
            $decryptedData = json_decode($this->fromEncryptedString($encryptedData), true);
        } catch (\Exception $e) {
            abort(403, 'Invalid or expired link');
        }
        
        $projectvendor = ProjectVendor::findOrFail($decryptedData['projectvendor']);
        $projectid = Project::findOrFail($decryptedData['projectid']);
        $contractid = ContractTemplate::findOrFail($decryptedData['contractid']);
        $vendorid = VendorContract::findOrFail($decryptedData['vendorid']);
        if($projectvendor->link_status=='Rejected'||$projectvendor->link_status=='Removed')
        {
            return view('errors.link-expired');
        }
        return view('workorder', [
            'projectvendor'=>$projectvendor,
            'projectid'=>$projectid,
            'contractid'=>$contractid,
            'vendorid'=>$vendorid,
            'company' => $company,
            'pageTitle' => $pageTitle,
            'pageIcon' => $pageIcon,
            
        ]);
    }
    public function WoStore(Request $request){

        if ($request->action == 'accept') {
       
            
            $projectvendor = ProjectVendor::findOrFail($request->data);
           
            $projectvendor->link_status='Accepted';
            $projectvendor->accepted_date=date("Y-m-d");
            $projectvendor->save();
            $url = url()->temporarySignedRoute(
                'external.expense.view',
                now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),
                ['pid' => $projectvendor->project_id,
                'vid'=>$projectvendor->id]
            );
        
            $url = getDomainSpecificUrl($url, $this->company);

            Notification::route('mail', $projectvendor->vendor_email_address)->notify(new WorkOrderAcceptNotification($projectvendor->id,'original',$url));
            ProcessWorkOrder::dispatch($projectvendor->id)->onConnection('database')->onQueue('file-auto-upload');
            // $this->pdfAutoGen($projectvendor->id);               
            return Reply::success(__('Thank You. Your Response Has Been Noted'));
        } 
        elseif ($request->action == 'reject') {
            $projectvendor = ProjectVendor::findOrFail($request->data);
            $projectvendor->link_status='Rejected';
            $projectvendor->rejected_date=date("Y-m-d");
            $projectvendor->save();
           return Reply::success(__('Thank You For Your Time'));
        } 

    }

    public function ChangeNotifyStore(Request $request){

        if ($request->action == 'accept') {
            $vcn = VendorChangeNotification::findOrFail($request->data);
            $vcn->link_status='Accepted';
            $vcn->accepted_date=date("Y-m-d");
            $vcn->save();
            $projectvendor = ProjectVendor::findOrFail($vcn->project_vendor_id);
            $url = url()->temporarySignedRoute(
                'external.expense.view',
                now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),
                ['pid' => $projectvendor->project_id,
                'vid'=>$projectvendor->id]
            );
        
            $url = getDomainSpecificUrl($url, $this->company);
            Notification::route('mail', $projectvendor->vendor_email_address)->notify(new WorkOrderAcceptNotification($projectvendor->id,'change',$url));
            ProcessWorkOrder::dispatch($vcn->project_vendor_id)->onConnection('database')->onQueue('file-auto-upload');   
            
            return Reply::success(__('Thank You. Your Response Has Been Noted'));
        } 
        elseif ($request->action == 'reject') {
            $vcn = VendorChangeNotification::findOrFail($request->data);
            $vcn->link_status='Rejected';
            $vcn->rejected_date=date("Y-m-d");
            $vcn->save();
            ProcessWorkOrder::dispatch($vcn->project_vendor_id)->onConnection('database')->onQueue('file-auto-upload');
            return Reply::success(__('Thank You For Your Time'));
        } 
    }

    public function downloadPdf(Request $request){

        try {
            $encryptedData = $request->query('data');
            $decryptedData = json_decode($this->fromEncryptedString($encryptedData), true);
        } catch (\Exception $e) {
            abort(403, 'Invalid or expired link');
        }
        $this->pageTitle = 'app.menu.contracts';
        $this->pageIcon = 'fa fa-file';
        $this->company = Company::find(1);
        $this->projectvendor = ProjectVendor::findOrFail($decryptedData['projectvendor']);
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

   
}

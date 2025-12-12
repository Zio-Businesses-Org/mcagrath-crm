<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use App\Models\Company;
use App\Models\VendorWaiverFormTemplate;
use App\Models\VendorContract;
use App\Helper\Reply;
use App\Notifications\WaiverFormNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use App\Models\VendorGeneralSettings;
use App\Jobs\SendSelfWaiverNotificationJob;

class PublicWaiverFormController extends Controller
{
    public function fromEncryptedString($value)
    {
            return Crypt::decryptString($value);
    }

    public function WaiverView(Request $request){
        $pageTitle = 'WC Waiver Form';
        $pageIcon = 'fa fa-file';
        $company = Company::find(1);
        try {
            $encryptedData = $request->query('data');
            $decryptedData = json_decode($this->fromEncryptedString($encryptedData), true);
        } catch (\Exception $e) {
            abort(403, 'Invalid or expired link');
        }
        $templateid = VendorWaiverFormTemplate::first();
        $vendorid = VendorContract::findOrFail($decryptedData['vendorid']);
        return view('vendorwaiver', [
            'templateid'=>$templateid,
            'vendorid'=>$vendorid,
            'company' => $company,
            'pageTitle' => $pageTitle,
            'pageIcon' => $pageIcon,         
        ]);
    }

    public function WaiverStore(Request $request){

            if ($request->action == 'accept') {
                $vendor = VendorContract::findOrFail($request->data);
                $vendor->waiver_form_status = 'Signed';
                $vendor->waiver_signed_date = date('Y-m-d');
                $vendor->save();
                $vendor_general_settings = VendorGeneralSettings::first();
                Notification::route('mail', $vendor->vendor_email)->notify(new WaiverFormNotification($vendor));
                SendSelfWaiverNotificationJob::dispatch(
                    $vendor_general_settings->selfnotifymail,
                    $vendor
                )->delay(now()->addSeconds(10));
                //Notification::route('mail', $vendor_general_settings->selfnotifymail)->notify(new WaiverFormSelfNotification($vendor));
                return Reply::success(__('Thank You. Your Response Has Been Noted'));
            } 
            elseif ($request->action == 'reject') {
                $vendor = VendorContract::findOrFail($request->data);
                $vendor->waiver_form_status = 'Rejected';
                $vendor->save();
                return Reply::success(__('Thank You. Your Response Has Been Noted'));
            } 
    
    }

    public function downloadPdf($id)
    {
        $this->vendorid = VendorContract::findOrFail($id);
        $this->pageTitle = 'app.menu.contracts';
        $this->pageIcon = 'fa fa-file';
        $this->company = Company::find(1);
        $this->templateid = VendorWaiverFormTemplate::first();
        $pdf = app('dompdf.wrapper');

        $pdf->setOption('enable_php', true);
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        App::setLocale('en');
        Carbon::setLocale('en');
        $pdf->loadView('vendors.waiverform-pdf', $this->data);

        $filename = 'waiverform-' . $this->vendorid->id;

        return $pdf->download($filename . '.pdf');
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Vendor;
use App\Models\VendorContract;
use App\Helper\Files;
use App\Helper\geocodeAddress;
use App\Models\Locations;
use Illuminate\Support\Facades\File;
use App\Helper\Reply;
use App\Http\Requests\vendor\SaveVendorRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VendorContractAcceptNotification;
use Illuminate\Support\Facades\App;

class OneTimeAgreeController extends Controller
{
    public function OtaView(Request $request){
        $pageTitle = 'app.menu.contracts';
        $pageIcon = 'fa fa-file';
        $company = Company::find(1);
        $id=$request->query('id');
        $vendorsign=Vendor::find($id);
        $startdate=$request->query('startdate');
        $enddate=$request->query('enddate');
        $name=$request->query('name');
        return view('vendorcontract', [
            'name'=>$name,
            'id'=>$id,
            'startdate'=>$startdate,
            'enddate'=>$enddate,
            'company' => $company,
            'pageTitle' => $pageTitle,
            'pageIcon' => $pageIcon,
            'vendor'=>$vendorsign,
        ]);
    }
    public function vendorfredirect(Request $request){
        $id = $request->query('id');
        $vendor=Vendor::find($id);
        if($request->status=='accepted'){
            // if($vendor->v_status=='rejected')
            // {
            //     return Reply::error(__('Previously Declined Contract.'));
            // }
            // else{
                    $startDate = $request->query('startdate');
                    $endDate = $request->query('enddate');
                    
                    $vendor->v_status='Accepted';
                    $vendor->save();
                    $redirectUrl = route('front.formv.show', ['startdate' => $startDate, 'enddate' => $endDate,'id'=>$id]);
                    return response()->json(['redirect_url' => $redirectUrl]);
                // }
        }
        else{
            $vendor->v_status='Declined by Vendor';
            $vendor->reason=$request->details;
            $vendor->save();
            return Reply::success(__('Thank You For Your Time'));
        }
    }
    public function vendorformshow(Request $request)
    {
        $id = $request->query('id');
        $startdate=$request->query('startdate');
        $enddate=$request->query('enddate');
        $pageTitle = 'app.menu.contracts';
        $contracttype = VendorContract::getContractType();
        $company = Company::find(1);
        $location=Locations::select('state')->distinct()->get();;
         return view('vendorcontactform', [
            'id'=>$id,
            'startdate'=>$startdate,
            'enddate'=>$enddate,
            'company' => $company,
            'pageTitle' => $pageTitle,
            'contracttype'=>$contracttype,
            'location'=>$location,
        ]);
    }
    public function vendorstore(SaveVendorRequest $request)
    {
        $company = Company::find(1);
        $vendor=New VendorContract();
        $vendor->company_name=$request->company_name;
        $vendor->street_address=$request->street_address;
        $vendor->city=$request->city;
        $vendor->state=$request->state;
        $vendor->zip_code=$request->zipcode;
        $vendor->office=$request->office;
        $vendor->cell=$request->vendor_mobile;
        $vendor->vendor_name=$request->vendor_name;
        $vendor->vendor_email=$request->vendor_email;
        $vendor->website=$request->website;
        $vendor->licensed=$request->licensed;
        $vendor->license=$request->license;
        $vendor->license_expiry_date=$request->license_exp==null?null: Carbon::createFromFormat($company->date_format, $request->license_exp)->format('Y-m-d');
        $vendor->insured=$request->insured;
        $vendor->gl_insurance_expiry_date=$request->gl_ins_exp==null?null:Carbon::createFromFormat($company->date_format, $request->gl_ins_exp)->format('Y-m-d');
        $vendor->gl_insurance_carrier_name=$request->gl_ins_cn;
        $vendor->gl_insurance_carrier_phone=$request->gl_ins_cp;
        $vendor->gl_insurance_carrier_email_address=$request->gl_ins_em;
        $vendor->Workers_comp_available=$request->wca;
        $vendor->wc_insurance_carrier_name=$request->wc_ins_cn;
        $vendor->wc_insurance_carrier_phone=$request->wc_ins_cp;
        $vendor->wc_insurance_carrier_email_address=$request->wc_ins_em;
        $vendor->wc_insurance_expiry_date=$request->wc_ins_exp==null?null:Carbon::createFromFormat($company->date_format, $request->wc_ins_exp)->format('Y-m-d');;
        $vendor->contract_start=$request->contract_start;
        $vendor->contract_end=$request->contract_end;
        $vendor->vendor_track_id=$request->id;
        $vendor->gl_insurance_policy_number=$request->gl_ins_pn;
        $vendor->wc_insurance_policy_number=$request->wc_ins_pn;
        $vendor->payment_methods=json_encode($request->payment_methods);
        $vendor->status='Active';
        $vendor->contractor_type=$request->contracttype;
        $vendor->distance_covered=$request->dc;
        $vendor->coverage_cities=$request->cc;
        $vendor->county=$request->county;
        $fullAddress = "{$vendor->street}, {$vendor->city}, {$vendor->state}, {$vendor->zipcode}";
        $location = geocodeAddress::geocode_address($fullAddress);
        if ($location) {
            $vendor->latitude = $location['lat'];
            $vendor->longitude = $location['lng'];
        }
        if ($request->hasFile('logo')) {
            $logo = Files::uploadLocalOrS3($request->logo, 'vendor/logo', 300);
            $vendor->company_logo=$logo;
        }
        
        if ($request->signature_type == 'signature') {
            $image = $request->signature;  // your base64 encoded
          
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = str_random(32) . '.' . 'jpg';

            Files::createDirectoryIfNotExist('vendor/sign');

            File::put(public_path() . '/' . Files::UPLOAD_FOLDER . '/vendor/sign/' . $imageName, base64_decode($image));
            Files::uploadLocalFile($imageName, 'vendor/sign');
        }
        else {
            if ($request->hasFile('image')) {
                $imageName = Files::uploadLocalOrS3($request->image, 'vendor/sign', 300);
            }
        }
        $vendor->contract_sign=$imageName;
        $vendor->signed_date=date("Y-m-d");
        $vendorst=Vendor::find($request->id);
        $vendorst->v_status='Profile Created';
        $vendorst->sign=$imageName;
        $vendor->created_by=$vendorst->created_by;
        $vendorst->save();
        $vendor->save();
        //return Reply::success(__(''));
        $redirectUrl = route('front.ota.show');

        if($request->vendor_email)
        {
            Notification::route('mail', $request->vendor_email)->notify(new VendorContractAcceptNotification($vendor));
        }
        //return Reply::successWithData(__('Thank you for updating your profile details and Welcome to our team!'), ['redirectUrl' => $redirectUrl]);
        return Reply::dataOnly(['status' => 'success' ]);
    }

    public function downloadPdf(Request $request)
    {
        $this->contract = VendorContract::findOrFail($request->id);
        $this->pageTitle = 'app.menu.contracts';
        $this->pageIcon = 'fa fa-file';
        $this->company = Company::find(1);
        $pdf = app('dompdf.wrapper');

        $pdf->setOption('enable_php', true);
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        App::setLocale('en');
        Carbon::setLocale('en');
        $pdf->loadView('vendors.contract-pdf', $this->data);

        $filename = 'contract-' . $this->contract->id;

        return $pdf->download($filename . '.pdf');

    }
}

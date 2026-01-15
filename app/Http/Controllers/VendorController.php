<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Helper\Files;
use App\Helper\Reply;
use App\Models\Project;
use App\Models\ProjectVendor;
use App\DataTables\ProjectsDataTable;
use App\DataTables\VendorEstimatesDataTable;
use App\Models\BaseModel;
use App\Scopes\ActiveScope;
use App\Traits\ImportExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\VendorContract;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\VendorWaiverFormTemplate;
use App\DataTables\VendorDataTable;
use App\DataTables\VendorModuleNotesDataTable;
use Carbon\Carbon;
use App\Models\Lead;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use App\Http\Requests\vendor\SaveVendorRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewVendorWaiverForm;
use App\DataTables\ProjectNotesDataTable;
use App\Models\ContractorType;
use App\Models\Locations;
use App\Models\VendorCustomFilter;
use App\Models\VendorContractorLicenseDoc;
use App\Models\VendorCoiDoc;
use App\Models\VendorBuisnessLicenseDoc;
use App\Models\VendorWorkersCompDoc;
use App\Models\VendorWnineDoc;
use App\Models\VendorWaiverFormDoc;

class VendorController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.vendors';
    
    }
    public function index(VendorDataTable $dataTable)
    {
        if (!request()->ajax()) {
            $this->clients = VendorContract::all();
            // $this->vendorStatus = VendorContract::getStatus(); 
            $this->contracttype = ContractorType::all();
            $this->state=Locations::select('state')->distinct()->get();
            $this->county=Locations::select('county')->distinct()->get();
            $this->city=Locations::select('city')->distinct()->get();
            $this->allEmployees = User::allEmployees(null, true, 'all');
            $this->vendorFilter = VendorCustomFilter::where('user_id', user()->id)->get();
        }

        return $dataTable->render('vendors.index', $this->data);
    }
    public function show($id)
    {
        $tab = request('tab');
        
        $this->vendorDetail = VendorContract::findOrFail($id);

        $this->pageTitle = $this->vendorDetail->vendor_name;

        $dataArray = json_decode($this->vendorDetail->payment_methods, true); 

        $sanitizedData = array_map(function ($item) {
            return str_replace(['[', ']', ','], '', $item);
        }, $dataArray);

        $this->joinedData= implode(', ', $sanitizedData);

        switch ($tab) {
            case 'notes':
                return $this->notes();
                break;
            case 'doc':
                $this->coi = VendorCoiDoc::where('vendor_id', $id)->first();
                $this->contractor_license = VendorContractorLicenseDoc::where('vendor_id', $id)->first();
                $this->buisness_license = VendorBuisnessLicenseDoc::where('vendor_id', $id)->first();
                $this->workers_comp = VendorWorkersCompDoc::where('vendor_id', $id)->first();
                $this->wnine = VendorWnineDoc::where('vendor_id', $id)->first();
                $this->waiver_form = VendorWaiverFormDoc::where('vendor_id', $id)->first();
                $this->view = 'vendors.ajax.docs';
                break;
            case 'projects':
                return $this->projects();
                break;
            case 'estimates':
                return $this->estimates();
                break;
            default:
                $this->view = 'vendors.ajax.profile';
                break;
        }

        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }
       
        $this->activeTab = $tab ?: 'profile';

        

        return view('vendors.show', $this->data);
    }
    public function edit($id)
    {
        $this->vendor = VendorContract::find($id);
        $this->pageTitle = __('app.update') . ' ' . __('Vendor');
        $this->vendorStatus = VendorContract::getStatus(); 
        $this->view = 'vendors.ajax.edit';
        $this->contracttype = VendorContract::getContractType();
        
        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }

        return view('vendors.create', $this->data);

    }
    public function update(SaveVendorRequest $request, $id)
    {
        

        $vendor=VendorContract::find($id);
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
       //$vendor->license_expiry_date=($request->license_exp!=$vendor->license_expiry_date&&!empty(trim($request->license_exp)))?companyToYmd($request->license_exp):null;
        $vendor->insured=$request->insured;
      //  $vendor->gl_insurance_expiry_date=($request->gl_ins_exp!=$vendor->gl_insurance_expiry_date&&!empty(trim($request->gl_ins_exp)))?companyToYmd($request->gl_ins_exp):null;
        $vendor->gl_insurance_carrier_name=$request->gl_ins_cn;
        $vendor->gl_insurance_carrier_phone=$request->gl_ins_cp;
        $vendor->gl_insurance_carrier_email_address=$request->gl_ins_em;
        $vendor->Workers_comp_available=$request->wca;
        $vendor->wc_insurance_carrier_name=$request->wc_ins_cn;
        $vendor->wc_insurance_carrier_phone=$request->wc_ins_cp;
        $vendor->wc_insurance_carrier_email_address=$request->wc_ins_em;
       // $vendor->wc_insurance_expiry_date=($request->wc_ins_exp!=$vendor->wc_insurance_expiry_date&&!empty(trim($request->wc_ins_exp)))?companyToYmd($request->wc_ins_exp):null;
       $vendor->contractor_type=$request->contracttype;
        $vendor->status=$request->status;
        $vendor->payment_methods=json_encode($request->payment_methods);
        $vendor->gl_insurance_policy_number=$request->gl_ins_pn;
        $vendor->wc_insurance_policy_number=$request->wc_ins_pn;
        $vendor->county=$request->county;
        $vendor->license_check=$request->has('license_check')?1:0;
        $vendor->gl_insurance_check=$request->has('gl_insurance_check')?1:0;
        $vendor->wc_check=$request->has('wc_check')?1:0;
        $vendor->coverage_cities = $request->cc;
        $vendor->distance_covered = $request->dc;
        
        if($request->wc_ins_exp!=$vendor->wc_insurance_expiry_date&&!empty(trim($request->wc_ins_exp)))
        {
            
            $vendor->wc_insurance_expiry_date=companyToYmd($request->wc_ins_exp);
            
        }
        elseif(empty(trim($request->wc_ins_exp))){
            $vendor->wc_insurance_expiry_date=null;
        }
        else{
            $vendor->wc_insurance_expiry_date=$request->wc_ins_exp;
        }
        if($request->gl_ins_exp!=$vendor->gl_insurance_expiry_date&&!empty(trim($request->gl_ins_exp)))
        {
            
            $vendor->gl_insurance_expiry_date=companyToYmd($request->gl_ins_exp);
            
        }
        elseif(empty(trim($request->gl_ins_exp))){
            $vendor->gl_insurance_expiry_date=null;
        }
        else{
            $vendor->gl_insurance_expiry_date=$request->gl_ins_exp;
        }
        if($request->license_exp!=$vendor->license_expiry_date&&!empty(trim($request->license_exp)))
        {
            
            $vendor->license_expiry_date=companyToYmd($request->license_exp);
            
        }
        elseif(empty(trim($request->license_exp))){
            $vendor->license_expiry_date=null;
        }
        else{
            $vendor->license_expiry_date=$request->license_exp;
        }
        
        if ($request->has('company_logo_delete') ) {
            $filePath='vendor/logo/' . $vendor->company_logo;
            Storage::disk('s3')->delete($filePath);
            $data['company_logo'] = null;
            DB::table('vendor_contracts')->where('id', $id)->update($data);
        }
        if ($request->hasFile('company_logo')) {
            $filePath='vendor/logo/' . $vendor->company_logo;
            Storage::disk('s3')->delete($filePath);
            $data['company_logo'] = Files::uploadLocalOrS3($request->company_logo, 'vendor/logo', 300);
            DB::table('vendor_contracts')->where('id', $id)->update($data);
        }
        $redirectUrl = route('vendors.index');
        $vendor->save();
        return Reply::successWithData(__('messages.updateSuccess'), ['redirectUrl' => $redirectUrl]);
    }
      /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = VendorContract::find($id);

        if ($vendor) {
            // Delete the user
            $vendor->delete();

        }

        return Reply::success(__('messages.deleteSuccess'));
    }
    public function companysign(Request $request)
    {  
        $vendor = VendorContract::find($request->id);
        if($vendor){
        if ($request->signature_type == 'signature') {
            $image = $request->signature;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = str_random(32) . '.' . 'jpg';

            Files::createDirectoryIfNotExist('vendor/company_sign');

            File::put(public_path() . '/' . Files::UPLOAD_FOLDER . '/vendor/company_sign/' . $imageName, base64_decode($image));
            Files::uploadLocalFile($imageName, 'vendor/company_sign', $this->company->id);
        }
        else {
            if ($request->hasFile('image')) {
                $imageName = Files::uploadLocalOrS3($request->image, 'vendor/company_sign', 300);
            }
        }
        $vendor->company_sign=$imageName;
        $vendor->company_sign_date=date("Y-m-d");
        $vendor->save();
        return Reply::success(__('Signed'));
        }
    
    }
    
    public function download($id)
    {
        $this->contract = VendorContract::findOrFail($id);
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
    
    public function sendwcform(Request $request)
    {
        $vendor= VendorContract::findOrFail($request->id);
        Notification::route('mail', $vendor->vendor_email)->notify(new NewVendorWaiverForm($vendor->id));
        return Reply::success(__('Mail Send'));
    }
    public function downloadwaiverform($id)
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
    public function changevendorstatus(Request $request, $id)
    {
        $vendor = VendorContract::findOrFail($id);
        $vendor->status=$request->value;
        $vendor->save();
        return Reply::success(__('Updated'));
    }

    public function notes()
    {
        
        $dataTable = new VendorModuleNotesDataTable();

        $tab = request('tab');
        $this->activeTab = $tab ?: 'profile';
        $this->view = 'vendors.ajax.notes';
        return $dataTable->render('vendors.show', $this->data);

    }

    public function projects()
    {
        
        $dataTable = new ProjectsDataTable();

        $tab = request('tab');
        
        $this->activeTab = $tab ?: 'profile';
        $this->view = 'vendors.ajax.projects';
        return $dataTable->render('vendors.show', $this->data);

    }

    public function estimates()
    {
        
        $dataTable = new VendorEstimatesDataTable();

        $tab = request('tab');
        
        $this->activeTab = $tab ?: 'profile';
        $this->view = 'vendors.ajax.estimates';
        return $dataTable->render('vendors.show', $this->data);

    }

    public function vendorList($id)
    {
        if ($id != 0) {
            $vendor =ProjectVendor::where('project_id', $id)
            ->where('link_status', 'accepted')
            ->select('id','vendor_id','vendor_name') // replace 'column_name' with the actual column you want distinct values from
            ->distinct()
            ->get();
            $options = BaseModel::optionsvendor($vendor, null, 'vendor_name');
            // \Log::info($options);
        }
        else {
            $options = '<option value="">--</option>';
        }

        return Reply::dataOnly(['status' => 'success', 'data' => $options]);
    }

    public function vendorListExpenses($id)
    {
        if ($id != 0) {
            $vendor =ProjectVendor::where('project_id', $id)
            ->where('link_status', 'accepted')
            ->select('id','vendor_id','vendor_name') // replace 'column_name' with the actual column you want distinct values from
            ->distinct()
            ->get();
            $options = BaseModel::optionsvendorexpense($vendor, null, 'vendor_name');
            // \Log::info($options);
        }
        else {
            $options = '<option value="">--</option>';
        }

        return Reply::dataOnly(['status' => 'success', 'data' => $options]);
    }

    public function proximity_view()
    {
        $this->pageTitle = 'Vendor Proximity';
        $this->apikey = global_setting()->google_map_key;
        $this->contracttype = VendorContract::getContractType();
        $vendors = VendorContract::whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->get(['vendor_name', 'latitude', 'longitude', 'street_address', 'city', 'state', 'zip_code', 'id']);

        $vendors->transform(function ($vendor) {
            $vendor->profile_url = route('vendors.show', $vendor->id); // or use route name that matches
            return $vendor;
        });

        $this->vendors = $vendors;
        return view('vendors.proximity', $this->data);
    }
}

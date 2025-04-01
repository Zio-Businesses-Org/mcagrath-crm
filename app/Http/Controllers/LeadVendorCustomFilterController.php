<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadVendorCustomFilter;
use App\Helper\Reply;
use App\Models\ContractorType;
use App\Models\LeadSource;
use App\Models\Locations;
use App\Models\Vendor;
use App\Models\User;

class LeadVendorCustomFilterController extends AccountBaseController
{
    public function store(Request $request)
    { 
        $request->validate([
            'filter_name' => 'required',
        ]);
        $vcf = new LeadVendorCustomFilter();
        $vcf->user_id = $request->user_id;
        $vcf->start_date = $request->startDate;
        $vcf->end_date = $request->endDate;
        $vcf->state = $request->filter_state;
        $vcf->county = $request->filter_county;
        $vcf->city = $request->filter_city;
        $vcf->contractor_type = $request->filter_contractor_type;
        $vcf->lead_source = $request->filter_lead_source;
        $vcf->created_by = $request->filter_members;
        $vcf->name=$request->filter_name;
        $vcf->lead_vendor_status = $request->filter_status;
        $vcf->save();

        return Reply::success(__('Filter Saved'));
    }

    public function edit($id)
    {
        $this->vendorStatuses = Vendor::getStatuses();
        $this->contracttype = ContractorType::all();
        $this->state=Locations::select('state')->distinct()->get();
        $this->county=Locations::select('county')->distinct()->get();
        $this->city=Locations::select('city')->distinct()->get();
        $this->allEmployees = User::allEmployees(null, null, 'all');
        $this->leadsource=LeadSource::all();
        $this->filter = LeadVendorCustomFilter::findOrFail($id);
        return view('vendortrack.edit-filter', $this->data);
    }

    public function update (Request $request,$id)
    { 
        $request->validate([
            'filter_name' => 'required',
        ]);
        $vcf = LeadVendorCustomFilter::findOrFail($id);
        $vcf->start_date = $request->filterstartDate;
        $vcf->end_date = $request->filterendDate;
        $vcf->state = $request->filter_state;
        $vcf->county = $request->filter_county;
        $vcf->city = $request->filter_city;
        $vcf->contractor_type = $request->filter_contractor_type;
        $vcf->lead_source = $request->filter_lead_source;
        $vcf->created_by = $request->filter_members;
        $vcf->name=$request->filter_name;
        $vcf->lead_vendor_status = $request->filter_status;
        $vcf->save();

        return Reply::success(__('Filter Saved'));
    }

    public function destroy($id)
    {
        LeadVendorCustomFilter::destroy($id);
        return Reply::success(__('Deleted Successfully'));
    }
    
    public function changestatus($id){
        $projectFilter = LeadVendorCustomFilter::where('user_id', user()->id)->get();
        foreach ($projectFilter as $filter)
        {
            $filter->status='inactive';
            $filter->save();
        }
        $filter = LeadVendorCustomFilter::findOrFail($id);
        $filter->status = 'active';
        $filter->save();
        return Reply::success(__('Filter Applied'));
    }

    public function clear($id){

        $filter = LeadVendorCustomFilter::findOrFail($id);
        $filter->status = 'inactive';
        $filter->save();
        return Reply::success(__('Filter Removed'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Helper\Reply;
use App\Models\GlobalSetting;
use App\Models\vendor_estimates;
use App\Models\EstimateTemplateItemImage;
use App\Models\EstimateTemplate;
use App\Models\UnitType;
use App\Models\Currency;
use App\Http\Requests\StoreVendorEstimates;
use App\Models\vendor_estimates_items;
use App\Models\Company;
use App\Models\ProjectVendor;
use App\Models\VendorEstimateFiles;
use Carbon\Carbon;
use App\Helper\Files;
use App\Traits\IconTrait;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EstimateReplyNotification;
use App\Models\VendorContract;

class PublicVendorEstimateController extends Controller
{
    public function generateDialog()
    {

        $this->project = Project::all();
        return view('estimates-vendor.external-dialog', $this->data);
    }

    public function generateLink(Request $request)
    {
        $url = url()->temporarySignedRoute(
            'external.expense.view',
            now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),
            ['pid' => $request->project_id,
             'vid'=>$request->vendor_id]
        );
        
        $url = getDomainSpecificUrl($url, $this->company);
        
        return Reply::dataOnly(['status' => 'success', 'url' => $url]);
    }

    public function ExpenseView(Request $request)
    {
        
        $this->pageTitle = __('modules.estimates.createEstimate');
        $this->currencies = Currency::all();
        $this->lastEstimate = vendor_estimates::lastEstimateNumber() + 1;
        $this->invoiceSetting = invoice_setting();
        $this->zero = '';
        $this->company = Company::find(1);
        $this->project=request('project_id') ? Project::findOrFail(request('project_id')) : null;
        $this->project= Project::findOrFail($request->pid);
        $this->vendor = ProjectVendor::findOrFail($request->vid);
        if (strlen($this->lastEstimate) < $this->invoiceSetting->estimate_digit) {
            $condition = $this->invoiceSetting->estimate_digit - strlen($this->lastEstimate);

            for ($i = 0; $i < $condition; $i++) {
                $this->zero = '0' . $this->zero;
            }
        }
       
        $this->units = UnitType::all();

        $this->estimateTemplate = request('template') ? EstimateTemplate::findOrFail(request('template')) : null;


        $this->estimateTemplateItem = request('template') ? EstimateTemplateItem::with('estimateTemplateItemImage')->where('estimate_template_id', request('template'))->get() : null;

        $this->view = 'external-estimate';

        if (request()->ajax()) {
            return $this->returnAjax($this->view);
        }

        return view($this->view, $this->data);
    }

    public function storeExternalEst(Request $request)
    {
        $items = $request->item_name;
        $cost_per_item = $request->cost_per_item;
        $quantity = $request->quantity;
        $amount = $request->amount;

        if (trim($items[0]) == '' || trim($cost_per_item[0]) == '') {
            return Reply::error(__('messages.addItem'));
        }

        foreach ($quantity as $qty) {
            if (!is_numeric($qty) && (intval($qty) < 1)) {
                return Reply::error(__('messages.quantityNumber'));
            }
        }

        foreach ($cost_per_item as $rate) {
            if (!is_numeric($rate)) {
                return Reply::error(__('messages.unitPriceNumber'));
            }
        }

        foreach ($amount as $amt) {
            if (!is_numeric($amt)) {
                return Reply::error(__('messages.amountNumber'));
            }
        }

        foreach ($items as $itm) {
            if (is_null($itm)) {
                return Reply::error(__('messages.itemBlank'));
            }
        }
        
        $company = Company::find(1);
        $estimate = new vendor_estimates();
        $estimate->skipObserver = true;
        $estimate->vendor_id = $request->vendor_id;
        $estimate->valid_till = $request->valid_till == null ? null: Carbon::createFromFormat($company->date_format, $request->valid_till)->format('Y-m-d');
        $estimate->project_id = $request->project_id;
        $estimate->sub_total = round($request->sub_total, 2);
        $estimate->total = round($request->total, 2);
        $estimate->currency_id = $request->currency_id;
        $estimate->note = trim_editor($request->note);
        $estimate->discount = round($request->discount_value, 2);
        $estimate->discount_type = $request->discount_type;
        $estimate->status = 'waiting';
        $estimate->description = trim_editor($request->description);
        $estimate->company_id = 1;
        $estimate->external = 'Yes';
        $estimate->hash = md5(microtime());
        $estimate->estimate_number = \App\Helper\NumberFormat::estimate($request->estimate_number, $company->invoiceSetting);
        $estimate->original_estimate_number = str($estimate->estimate_number)->replace($company->invoiceSetting->estimate_prefix . $company->invoiceSetting->estimate_number_separator, '');
        $estimate->save();
        $vendor = VendorContract::findOrFail($request->vendor_id);
        Notification::route('mail', $vendor->vendor_email)->notify(new EstimateReplyNotification($estimate->id));
        return Reply::successWithData(__('messages.recordSaved'), ['estimateId' => $estimate->id]);
    }

    public function storeExternalEstFiles(Request $request)
    {
        if ($request->hasFile('file')) {

            $defaultImage = null;

            foreach ($request->file as $fileData) {
                $file = new VendorEstimateFiles();
                $file->vendor_estimates_id = $request->estimates_id;

                $filename = Files::uploadLocalOrS3($fileData, VendorEstimateFiles::FILE_PATH);

                $file->filename = $fileData->getClientOriginalName();
                $file->hashname = $filename;
                $file->added_by = 1;
                $file->skipObserver = true;
                $file->last_updated_by = 1;
                $file->size = $fileData->getSize();
                $file->created_at = now()->format('Y-m-d H:i:s');
                $file->save();
            }

        }
        
    }
    public function downloadPdf(Request $request)
    {
        
        $this->estimate = vendor_estimates::findOrFail($request->id);
        $this->company = Company::findOrFail(1);
        $this->invoiceSetting = invoice_setting();
        $this->discount = 0;

        if ($this->estimate->discount > 0) {
            if ($this->estimate->discount_type == 'percent') {
                $this->discount = (($this->estimate->discount / 100) * $this->estimate->sub_total);
            }
            else {
                $this->discount = $this->estimate->discount;
            }
        }

        $pdf = app('dompdf.wrapper');

        $pdf->setOption('enable_php', true);
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        App::setLocale('en');
        Carbon::setLocale('en');
        $pdf->loadView('estimates-vendor.pdf.invoice-5', $this->data);

        $filename = $this->estimate->estimate_number;

        return $pdf->download($filename . '.pdf');

    }
}

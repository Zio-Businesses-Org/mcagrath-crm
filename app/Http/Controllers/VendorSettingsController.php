<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContractTemplate;
use Illuminate\Support\Facades\Log;
use App\Models\VendorWaiverFormTemplate;
use App\Models\WorkOrderStatus;
use App\Models\SOWTitle;
use App\Models\VendorWorkOrderStatus;
use App\Helper\Reply;
use App\Models\VendorGeneralSettings;

class VendorSettingsController extends AccountBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Vendor Settings';
        $this->activeSettingMenu = 'vendor_settings';
        $this->middleware(function ($request, $next) {
            abort_403(user()->permission('manage_company_setting') !== 'all');

            return $next($request);
        });
    }
    public function index()
    {
        $tab = request('tab');

        switch ($tab) {

        case 'wcform':
            $this->contract=ContractTemplate::all();
            $this->wform=VendorWaiverFormTemplate::first();
            $this->vendor_status = VendorWorkOrderStatus::first();
            $this->vendor_general_settings = VendorGeneralSettings::first();
            $this->view = 'vendor-settings.ajax.wcform';
            break;

        case 'wostatus':
            $this->view = 'vendor-settings.ajax.wostatus';
            $this->wostatus = WorkOrderStatus::all();
            break;

        case 'sowtitle':
            $this->view = 'vendor-settings.ajax.sowtitle';
            $this->sowtitle = SOWTitle::all();
            break;
       
        default:
            $this->contract=ContractTemplate::all();
            $this->wform=VendorWaiverFormTemplate::first();
            $this->vendor_status = VendorWorkOrderStatus::first();
            $this->vendor_general_settings = VendorGeneralSettings::first();
            $this->view = 'vendor-settings.ajax.wcform';
            break;
        }

        $this->activeTab = $tab ?: 'wcform';

        if (request()->ajax()) {
            $html = view($this->view, $this->data)->render();

            return Reply::dataOnly(['status' => 'success', 'html' => $html, 'title' => $this->pageTitle, 'activeTab' => $this->activeTab]);
        }

        return view('vendor-settings.index', $this->data);
    }
    public function store(Request $request)
    {
        
        if (VendorWaiverFormTemplate::exists()) {
            if($request->value){
            $contract=ContractTemplate::findOrFail($request->value);
            $wform = VendorWaiverFormTemplate::first();
            $wform->waiver_template = $contract->contract_detail;
            $wform->save();
            return Reply::success(__('Updated'));
            }
        }
         else {
            if($request->value){
            $contract=ContractTemplate::findOrFail($request->value);
            $wform = new VendorWaiverFormTemplate();
            $wform->waiver_template = $contract->contract_detail;
            $wform->save();
            return Reply::success(__('Updated'));
            }
        }
    }
    public function createWorkOrderStatus()
    {
        return view('vendor-settings.create-vendor-work-order-settings-modal', $this->data);
    }

    public function createSOWTitle()
    {
        return view('vendor-settings.create-sow-title-settings-modal', $this->data);
    }

    public function saveWorkOrderStatus(Request $request)
    {
        $request->validate([
            'wo_status' => 'required',
        ]);
        $wos = new WorkOrderStatus();
        $wos->wo_status = $request->wo_status;
        $wos->save();
        return Reply::success(__('messages.recordSaved'));
    }

    public function saveSOWTitle(Request $request)
    {
        $request->validate([
            'sow_title' => 'required',
        ]);
        $sow = new SOWTitle();
        $sow->sow_title = $request->sow_title;
        $sow->save();
        return Reply::success(__('messages.recordSaved'));
    }

    public function saveSelfNotifyMail(Request $request)
    {
        if (VendorGeneralSettings::exists())
        {
            $vgs = VendorGeneralSettings::first();
            $vgs->selfnotifymail = $request->value;
            $vgs->save();
            return Reply::success(__('messages.recordSaved'));
        }
        else{
            $vgs = new VendorGeneralSettings();
            $vgs->selfnotifymail = $request->value;
            $vgs->save();
            return Reply::success(__('messages.recordSaved'));
        }
    }

    public function toggleDuplicateEntry(Request $request)
    {
        $vgs = VendorGeneralSettings::first();
        $vgs->duplicate_entry_check = $request->value;
        $vgs->save();
        return Reply::success(__('messages.recordSaved'));
        
    }
}

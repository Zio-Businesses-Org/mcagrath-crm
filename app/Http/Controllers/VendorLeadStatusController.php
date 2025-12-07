<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorLeadStatus;
use App\Helper\Reply;

class VendorLeadStatusController extends AccountBaseController
{
    public function create()
    {
        return view('lead-settings.create-vendor-lead-status-modal', $this->data);
    }
    public function store(Request $request)
    {
         $request->validate([
            'status' => 'required',
        ]);
        $vls = new VendorLeadStatus();
        $vls->status = $request->status;
        $vls->save();
        return Reply::success(__('Updated'));
    }
    public function edit($id)
    {
        $this->vls = VendorLeadStatus::findOrfail($id);

        return view('lead-settings.edit-vendor-lead-status-modal', $this->data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $vls = VendorLeadStatus::findOrFail($id);
        $vls->status = $request->status;
        $vls->save();
        return Reply::success(__('messages.updateSuccess'));
    }
    
    public function destroy($id)
    {
        VendorLeadStatus::destroy($id);
        return Reply::success(__('messages.deleteSuccess'));
    }
}

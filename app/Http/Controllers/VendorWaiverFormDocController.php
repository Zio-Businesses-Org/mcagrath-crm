<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorWaiverFormDoc;
use App\Helper\Files;
use App\Helper\Reply;

class VendorWaiverFormDocController extends AccountBaseController
{
    public function store(Request $request)
    {
        if ($request->hasFile('waiver_form')) {
           
        $file = new VendorWaiverFormDoc();
        $fileData = $request->waiver_form;
        $file->vendor_id = $request->vendor_id_waiver_form;
        $file->added_by = user()->id;
        $filename = Files::uploadLocalOrS3($fileData, VendorWaiverFormDoc::FILE_PATH);
        $file->filename = $fileData->getClientOriginalName();
        $file->hashname = $filename;
        $file->size = $fileData->getSize();
        $file->save();
        return Reply::success(__('Uploaded Successfully'));
        }
    }

    public function download($id)
    {
        $file = VendorWaiverFormDoc::whereRaw('md5(id) = ?', $id)->firstOrFail();

        return download_local_s3($file, VendorWaiverFormDoc::FILE_PATH . '/' . $file->hashname);
    }
    public function destroy($id)
    {
        
        $file = VendorWaiverFormDoc::findOrFail($id);

        Files::deleteFile($file->hashname, VendorWaiverFormDoc::FILE_PATH);

        VendorWaiverFormDoc::destroy($id);

        return Reply::success(__('messages.deleteSuccess'));
    }
    public function edit($id)
    {
        $this->expiry_date = VendorWaiverFormDoc::findOrFail($id);
        return view('vendors.waiver-form.edit', $this->data);
    }
    public function update(Request $request, $id)
    {
        $expiry_date = VendorWaiverFormDoc::findOrFail($id);
        $expiry_date->expiry_date = $request->expiry_date == null ? null : companyToYmd($request->expiry_date);
        $expiry_date->save();

        return Reply::success(__('Updated Successfully'));
    }
}

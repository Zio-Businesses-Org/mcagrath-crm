<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Project\StoreFileType;
use App\Models\ExternalFileType;
use App\Helper\Reply;

class ExternalFileTypeController extends AccountBaseController
{
    public function edit($id)
    {
        $this->file_type = ExternalFileType::findOrfail($id);

        return view('project-settings.edit-file-type', $this->data);
    }

    public function update(StoreFileType $request, $id)
    {
       
        $ft = ExternalFileType::findOrFail($id);
        $ft->file_type = $request->file_type;
        $ft->save();
        return Reply::success(__('messages.updateSuccess'));
    }
    
    public function destroy($id)
    {
        ExternalFileType::destroy($id);
        return Reply::success(__('messages.deleteSuccess'));
    }
}

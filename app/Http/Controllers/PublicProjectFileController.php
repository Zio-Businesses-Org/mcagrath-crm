<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Helper\Files;
use App\Helper\Reply;
use App\Models\Project;
use App\Models\ProjectExternalFile;
use Illuminate\Support\Facades\Cache;
use App\Models\ExternalFileType;

class PublicProjectFileController extends Controller
{
    public function FileView(Request $request)
    {
        $this->company = Company::find(1);
        $this->pageTitle = 'File Upload';
        $this->pageIcon = 'fa fa-file';
        $this->projectid = $request->query('data');
        $this->projectData = Project::select('id', 'project_short_code', 'property_details_id')->where('id', $this->projectid)->with(['propertyDetails:id,property_address'])->first();
        $this->filetype = ExternalFileType::all();
        return view('external-file', $this->data);
    }
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {

            $defaultImage = null;

            foreach ($request->file as $fileData) {
                $file = new ProjectExternalFile();
                $file->project_id = $request->projectid;
                $filename = Files::uploadLocalOrS3($fileData, ProjectExternalFile::FILE_PATH);
                $file->tag_name = $request->tag_name;
                $file->filename = $fileData->getClientOriginalName();
                $file->hashname = $filename;
                $file->size = $fileData->getSize();
                $file->file_type =  $request->file_type;
                $file->name = $request->name;
                $file->phone = $request->phone;
                $file->email = $request->email;
                $file->save();
            }

        }

        return Reply::success(__('messages.fileUploaded'));
    }
    public function download($id)
    {
        $file = ProjectExternalFile::whereRaw('md5(id) = ?', $id)->firstOrFail();
        
        return download_local_s3($file, ProjectExternalFile::FILE_PATH . '/' . $file->hashname);
    }

    public function destroy(Request $request, $id)
    {
        $file = ProjectExternalFile::findOrFail($id);

        Files::deleteFile($file->hashname, ProjectExternalFile::FILE_PATH);

        ProjectExternalFile::destroy($id);

        return Reply::success(__('messages.deleteSuccess'));
    }

    public function accessSharedFiles($key)
    {
        $this->company = Company::find(1);
        $this->pageIcon = 'fa fa-file';
        $this->files = Cache::get('shared_files_' . $key);
        return view('file-share', $this->data);
    }
}

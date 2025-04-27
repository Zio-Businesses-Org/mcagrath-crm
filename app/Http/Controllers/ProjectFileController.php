<?php

namespace App\Http\Controllers;

use App\Helper\Files;
use App\Helper\Reply;
use App\Models\ProjectFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GlobalSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ProjectFileController extends AccountBaseController
{
    /**
     * Store uploaded files
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $this->storeFiles($request);

            $this->files = ProjectFile::where('project_id', $request->project_id)
                ->orderByDesc('id')
                ->get();
                
            $view = view('projects.files.show', $this->data)->render();

            return Reply::dataOnly(['status' => 'success', 'view' => $view]);
        }

        return Reply::error('No file uploaded');
    }

    /**
     * Store multiple files
     */
    public function storeMultiple(Request $request)
    {
        if ($request->hasFile('file')) {
            $this->storeFiles($request);
            return Reply::success('Files uploaded successfully');
        }
        return Reply::error('No files uploaded');
    }

    /**
     * Store files helper method
     */
    private function storeFiles($request)
    {
        foreach ($request->file as $fileData) {
            $file = new ProjectFile();
            $file->project_id = $request->project_id;

            $filename = Files::uploadLocalOrS3(
                $fileData, 
                ProjectFile::FILE_PATH . '/' . $request->project_id
            );

            $file->user_id = $this->user->id;
            $file->filename = $fileData->getClientOriginalName();
            $file->hashname = $filename;
            $file->size = $fileData->getSize();
            $file->save();

            $this->logProjectActivity($request->project_id, 'messages.newFileUploadedToTheProject');
        }
    }

    /**
     * Delete a file
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $file = ProjectFile::findOrFail($id);
        
        $deleteDocumentPermission = user()->permission('delete_project_files');
        
        abort_403(!($deleteDocumentPermission == 'all' || 
            ($deleteDocumentPermission == 'added' && $file->added_by == user()->id)));

        Files::deleteFile($file->hashname, ProjectFile::FILE_PATH . '/' . $file->project_id);

        ProjectFile::destroy($id);

        $this->files = ProjectFile::where('project_id', $file->project_id)
            ->orderByDesc('id')
            ->get();

        $view = view('projects.files.show', $this->data)->render();

        return Reply::successWithData(__('messages.deleteSuccess'), ['view' => $view]);
    }

    /**
     * Download a file
     * 
     * @param string $id MD5 hashed ID
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id)
    {
        $file = ProjectFile::whereRaw('md5(id) = ?', $id)->firstOrFail();
        
        $this->viewPermission = user()->permission('view_project_files');
        
        abort_403(!($this->viewPermission == 'all' || 
            ($this->viewPermission == 'added' && $file->added_by == user()->id)));

        return download_local_s3($file, ProjectFile::FILE_PATH . '/' . $file->project_id . '/' . $file->hashname);
    }

    /**
     * Generate external file sharing link
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function FilesExternal($id)
    {
        $url = url()->temporarySignedRoute(
            'external.file.view',
            now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),
            ['data' => $id]
        );
        
        $url = getDomainSpecificUrl($url, $this->company);
        
        return Reply::dataOnly(['status' => 'success', 'url' => $url]);
    }
    
    public function shareSelectedFiles(Request $request)
    {
        try {
            

            $files = $request->input('files');

            $key = Str::random(10);

            Cache::put('shared_files_' . $key, $files, now()->addDays(3));

            $url = url()->temporarySignedRoute(
                'shared.files.access',
                now()->addDays(GlobalSetting::SIGNED_ROUTE_EXPIRY),
                ['key' => $key]
            );
            $url = getDomainSpecificUrl($url, $this->company);
            
            return Reply::successWithData('Shareable link generated successfully', [
                'status' => 'success',
                'link' => $url
            ]);

        } catch (\Exception $e) {
            \Log::error('File sharing error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return Reply::error('Failed to generate sharing link: ' . $e->getMessage());
        }
    }

}
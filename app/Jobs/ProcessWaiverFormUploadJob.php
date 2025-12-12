<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\VendorDocs;

class ProcessWaiverFormUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }

    public function pdfGeneration($id)
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

        $data = [
            'pageTitle' => $this->pageTitle,
            'pageIcon' => $this->pageIcon,
            'company' => $this->company,
            'templateid' => $this->templateid,
            'vendorid' => $this->vendorid,
        ];

        $pdf->loadView('vendors.waiverform-pdf', $data);
        
        $pdfContent = $pdf->download()->getOriginalContent();
        $filePath = "app/pdf/{$id}/waiverform-{$this->vendorid->vendor_name}.pdf";

        \Storage::disk('localBackup')->put($filePath, $pdfContent);

        $projectfile = VendorDocs::where('project_vendor_id', $projectvendorid)->first();

        if($projectfile)
        {
            Files::deleteFile($projectfile->hashname, ProjectFile::FILE_PATH . '/' . $this->projectid->id);

            ProjectFile::where('project_vendor_id', $projectvendorid)->delete();

            $filePathOnDisk = \Storage::disk('localBackup')->path($filePath);

            $uploadedFile = new UploadedFile(
                $filePathOnDisk,         // Full file path to the file
                basename($filePath),     // Original file name (without path)
                mime_content_type($filePathOnDisk),  // Mime type (you can use mime_content_type() or leave it as null)
                null,                    // Error flag (optional)
                true                     // Ensure it is marked as valid
            );

            $pf = new ProjectFile();
            $pf->project_id = $this->projectid->id;

            $filename = Files::uploadLocalOrS3($uploadedFile, ProjectFile::FILE_PATH . '/' . $this->projectid->id);

            $pf->user_id = 1;
            $pf->project_vendor_id = $projectvendorid;
            $pf->filename = $uploadedFile->getClientOriginalName();
            $pf->hashname = $filename;
            $pf->size = $uploadedFile->getSize();
            $pf->save();
            
        }
        else{
            
            $filePathOnDisk = \Storage::disk('localBackup')->path($filePath);
            $uploadedFile = new UploadedFile(
                $filePathOnDisk,         // Full file path to the file
                basename($filePath),     // Original file name (without path)
                mime_content_type($filePathOnDisk),  // Mime type (you can use mime_content_type() or leave it as null)
                null,                    // Error flag (optional)
                true                     // Ensure it is marked as valid
            );

            $pf = new ProjectFile();
            $pf->project_id = $this->projectid->id;

            $filename = Files::uploadLocalOrS3($uploadedFile, ProjectFile::FILE_PATH . '/' . $this->projectid->id);

            $pf->user_id = 1;
            $pf->project_vendor_id = $projectvendorid;
            $pf->filename = $uploadedFile->getClientOriginalName();
            $pf->hashname = $filename;
            $pf->size = $uploadedFile->getSize();
            $pf->save();
        }
        
    

        
    }
}

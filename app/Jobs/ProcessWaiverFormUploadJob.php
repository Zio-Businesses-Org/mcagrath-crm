<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\VendorWaiverFormDoc;
use App\Models\VendorContract;
use App\Models\Company;
use App\Models\VendorWaiverFormTemplate;
use App\Helper\Files;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class ProcessWaiverFormUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vendorId;
    /**
     * Create a new job instance.
     */
    public function __construct($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->pdfGeneration($this->vendorId);
    }

    public function pdfGeneration($vendorId)
    {
        $this->vendor = VendorContract::findOrFail($vendorId);
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
            'vendorid' => $this->vendor,
        ];

        $pdf->loadView('vendors.waiverform-pdf', $data);
        
        $pdfContent = $pdf->download()->getOriginalContent();
        $filePath = "app/pdf/{$this->vendor->id}/waiverform-{$this->vendor->vendor_name}.pdf";

        \Storage::disk('localBackup')->put($filePath, $pdfContent);

        $waiverformfile = VendorWaiverFormDoc::where('vendor_id', $this->vendor->id)->first();

        if($waiverformfile)
        {
            Files::deleteFile($waiverformfile->hashname, VendorWaiverFormDoc::FILE_PATH);
            VendorWaiverFormDoc::where('vendor_id', $this->vendor->id)->delete();

            $filePathOnDisk = \Storage::disk('localBackup')->path($filePath);

            $uploadedFile = new UploadedFile(
                $filePathOnDisk,         // Full file path to the file
                basename($filePath),     // Original file name (without path)
                mime_content_type($filePathOnDisk),  // Mime type (you can use mime_content_type() or leave it as null)
                null,                    // Error flag (optional)
                true                     // Ensure it is marked as valid
            );

            $file = new VendorWaiverFormDoc();
            $file->vendor_id = $this->vendor->id;
            $file->added_by = 1;
            $filename = Files::uploadLocalOrS3($uploadedFile, VendorWaiverFormDoc::FILE_PATH);
            $file->filename = $uploadedFile->getClientOriginalName();
            $file->hashname = $filename;
            $file->size = $uploadedFile->getSize();
            $file->save();
            
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

            $file = new VendorWaiverFormDoc();
            $file->vendor_id = $this->vendor->id;
            $file->added_by = 1;
            $filename = Files::uploadLocalOrS3($uploadedFile, VendorWaiverFormDoc::FILE_PATH);
            $file->filename = $uploadedFile->getClientOriginalName();
            $file->hashname = $filename;
            $file->size = $uploadedFile->getSize();
            $file->save();
        }
        
    }
}

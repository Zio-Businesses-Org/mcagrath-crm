<?php

namespace App\Observers;
use App\Models\VendorEstimateFiles;
use App\Helper\Files;

use Carbon\Carbon;

class VendorEstimatesFilesObserver
{
    public function saving(VendorEstimateFiles $Files)
    {
        if (!empty($Files->skipObserver)) {
            return;
        }
        if (!isRunningInConsoleOrSeeding()) {
            $Files->last_updated_by = user()->id;
        }
    }

    public function creating(VendorEstimateFiles $Files)
    {
        if (!empty($Files->skipObserver)) {
            return;
        }
        if (!isRunningInConsoleOrSeeding()) {
            $Files->added_by = user()->id;
            $Files->created_at = now()->format('Y-m-d H:i:s');
        }
    }

    /**
     * Handle the VendorEstimateFiles "deleted" event.
     */
    public function deleting(VendorEstimateFiles $Files)
    {
        Files::deleteFile($Files->hashname, VendorEstimateFiles::FILE_PATH);
    }
}

<?php

namespace App\Observers;

use File;
use Carbon\Carbon;
use App\Helper\Files;
use App\Models\Invoice;
use App\Models\vendor_estimates;
use Illuminate\Support\Str;
use App\Models\vendor_estimates_items;

use App\Traits\UnitTypeSaveTrait;

use function user;
use App\Traits\EmployeeActivityTrait;

class VendorEstimateObserver
{
    use EmployeeActivityTrait;


    use UnitTypeSaveTrait;

    public function saving(vendor_estimates $estimate)
    {
        if (!isRunningInConsoleOrSeeding()) {

            if (user()) {
                $estimate->last_updated_by = user()->id;
            }

            if (request()->has('calculate_tax')) {
                $estimate->calculate_tax = request()->calculate_tax;
            }
        }

    }

    public function creating(vendor_estimates $estimate)
    {
        if (!empty($estimate->skipObserver)) {
            return;
        }
        $estimate->hash = md5(microtime());

        if (user()) {
            $estimate->added_by = user()->id;
        }


        if (company()) {
            $estimate->company_id = company()->id;
        }


        if (is_numeric($estimate->estimate_number)) {
            $estimate->estimate_number = $estimate->formatEstimateNumber();
        }

        $invoiceSettings = (company()) ? company()->invoiceSetting : $estimate->company->invoiceSetting;
        $estimate->original_estimate_number = str($estimate->estimate_number)->replace($invoiceSettings->estimate_prefix . $invoiceSettings->estimate_number_separator, '');

    }

    public function created(vendor_estimates $estimate)
    {

        if (!isRunningInConsoleOrSeeding()) {
            if (user()) {
                self::createEmployeeActivity(user()->id, 'estimate-created', $estimate->id, 'estimate');
            }

            if (!empty(request()->item_name)) {

                $itemsSummary = request()->item_summary;
                $cost_per_item = request()->cost_per_item;
                $hsn_sac_code = request()->hsn_sac_code;
                $quantity = request()->quantity;
                $unitId = request()->unit_id;
                $product = request()->product_id;
                $amount = request()->amount;

                foreach (request()->item_name as $key => $item) :
                    if (!is_null($item)) {
                        $estimateItem = vendor_estimates_items::create(
                            [
                                'vendor_estimate_id' => $estimate->id,
                                'item_name' => $item,
                                'item_summary' => $itemsSummary[$key],
                                'type' => 'item',
                                'unit_id' => (isset($unitId[$key]) && !is_null($unitId[$key])) ? $unitId[$key] : null,
                                'hsn_sac_code' => (isset($hsn_sac_code[$key]) && !is_null($hsn_sac_code[$key])) ? $hsn_sac_code[$key] : null,
                                'quantity' => $quantity[$key],
                                'unit_price' => round($cost_per_item[$key], 2),
                                'amount' => round($amount[$key], 2),
                                
                            ]
                        );

                    }

                endforeach;
            }

        }
    }



}

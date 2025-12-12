<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VendorContract extends BaseModel
{

    use HasFactory;

    protected $table = 'vendor_contracts';
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        $company = company();
        return ($this->company_logo) ? asset_url_local_s3('vendor/logo/' . $this->company_logo) : $company->logo_url;
    }
    public function getSecondaryImageUrlAttribute()
    {
        return ($this->contract_sign) ? asset_url_local_s3('vendor/sign/' . $this->contract_sign) : null;
    }
    public function getTertiaryImageUrlAttribute()
    {
        return ($this->company_sign) ? asset_url_local_s3('vendor/company_sign/' . $this->company_sign) : null;
    }
    public static function getStatus()
    {
        return [
            'active',
            'not active',
            'do not use',
            'on hold',
        ];
    }
    public static function getContractType()
    {
        return [
            'Air Duct Cleaning',
            'Appliances & Repair',
            'Architects',
            'Biohazard Cleanup',
            'Building Supplies',
            'Cabinetry',
            'Carpenters',
            'Carpet Cleaning',
            'Chimney Sweeps',
            'Countertop Installation',
            'Damage Restoration',
            'Decks & Railing',
            'Demolition Services',
            'Door Sales/Installation',
            'Drywall Installation & Repair',
            'Electricians',
            'Environmental Abatement',
            'Environmental Testing',
            'Excavation Services',
            'Fences & Gates',
            'Fire Protection Services',
            'Fireplace Services',
            'Flooring',
            'Foundation Repair',
            'Furniture Assembly',
            'Garage Door Services',
            'Gardeners',
            'General Contractors',
            'Generator Installation/Repair',
            'Grout Services',
            'Gutter Services',
            'Handyman',
            'Heating & Air Conditioning/HVAC',
            'Home Cleaning',
            'Hydro-jetting',
            'Insulation Installation',
            'Irrigation',
            'Junk Removal & Hauling',
            'Keys & Locksmiths',
            'Landscape Architects or Designers',
            'Landscaping',
            'Lawn Services',
            'Lighting Fixtures & Equipment',
            'Masonry/Concrete',
            'Movers',
            'Painters',
            'Patio Coverings',
            'Pest Control',
            'Plumbing',
            'Pool & Hot Tub Service',
            'Pressure Washers',
            'Roofing',
            'Security Systems',
            'Septic Services',
            'Shades & Blinds',
            'Shutters',
            'Siding',
            'Structural Engineers',
            'Stucco Services',
            'Tiling',
            'Tree Services',
            'Water Heater Installation/Repair',
            'Water Purification Services',
            'Waterproofing',
            'Well Drilling',
            'Wildlife Control',
            'Window Washing',
            'Windows Installation',
        ];
    }
    public function docs(): HasMany
    {
        return $this->hasMany(VendorDocs::class, 'vendor_id')->orderByDesc('id');
    }

    public function vendorCoiDoc(): HasOne
    {
        return $this->hasOne(VendorCoiDoc::class, 'vendor_id');
    }

    public function vendorWnineDoc(): HasOne
    {
        return $this->hasOne(VendorWnineDoc::class, 'vendor_id');
    }

    public function vendorContractorLicenseDoc(): HasOne
    {
        return $this->hasOne(VendorContractorLicenseDoc::class, 'vendor_id');
    }

    public function vendorWorkersCompDoc(): HasOne
    {
        return $this->hasOne(VendorWorkersCompDoc::class, 'vendor_id');
    }

    public function vendorBuisnessLicenseDoc(): HasOne
    {
        return $this->hasOne(VendorBuisnessLicenseDoc::class, 'vendor_id');
    }

}

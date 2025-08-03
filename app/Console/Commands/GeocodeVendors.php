<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VendorContract;
use Illuminate\Support\Facades\Http;

class GeocodeVendors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:geocode-vendors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $vendors = VendorContract::whereNull('latitude')->orWhereNull('longitude')->get();

        foreach ($vendors as $vendor) {
            $address = "{$vendor->street_address}, {$vendor->city}, {$vendor->state}, {$vendor->zip_code}";
            $coords = $this->geocodeAddress($address);

            if ($coords) {
                $vendor->latitude = $coords['lat'];
                $vendor->longitude = $coords['lng'];
                $vendor->save();
                $this->info("Geocoded: {$vendor->vendor_name}");
            } else {
                $this->warn("Failed to geocode: {$vendor->vendor_name}");
            }

            sleep(1); // respect rate limits
        }

        $this->info('All done!');
    }

    private function geocodeAddress($address)
    {
        $apiKey = global_setting()->google_map_key;
        $url = 'https://maps.googleapis.com/maps/api/geocode/json';

        $response = Http::get($url, [
            'address' => $address,
            'key' => $apiKey,
        ]);

        $data = $response->json();

        if ($data['status'] === 'OK') {
            return [
                'lat' => $data['results'][0]['geometry']['location']['lat'],
                'lng' => $data['results'][0]['geometry']['location']['lng'],
            ];
        }

        return null;
    }
}

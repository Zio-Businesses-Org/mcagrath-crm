<?php

namespace App\Helper;
use Illuminate\Support\Facades\Http;

class geocodeAddress{

    public static function geocode_address(string $address): ?array
    {
        $apiKey = global_setting()->google_map_key;
        $url = 'https://maps.googleapis.com/maps/api/geocode/json';

        $response = Http::get($url, [
            'address' => $address,
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $json = $response->json();
            if (!empty($json['results']) && isset($json['results'][0]['geometry']['location'])) {
                return $json['results'][0]['geometry']['location'];
            }
        }

        return null;
    }

}


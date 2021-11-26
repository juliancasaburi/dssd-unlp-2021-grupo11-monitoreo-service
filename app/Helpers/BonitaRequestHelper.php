<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class BonitaRequestHelper
{
    /**
     * Obtener url de Bonita REST API.
     *
     * @return string
     */
    private static function getBonitaServerURL()
    {
        return config('services.bonita.api_url');
    }

    /**
     * Do a GET request.
     *
     * @param  string $endpoint
     * @param  string $jsessionid
     * @return mixed
     */
    public static function doTheRequest(string $endpoint, $jsessionid)
    {
        $response = Http::withHeaders([
            'Cookie' => 'JSESSIONID=' . $jsessionid
        ])->get(Self::getBonitaServerURL() . $endpoint);

        return $response->throw()->json();
    }
}

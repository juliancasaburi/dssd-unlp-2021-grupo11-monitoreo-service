<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class BonitaRequestHelper
{
    /**
     * Obtener url de Bonita REST API.
     *
     * @param  string $endpointName
     * @return string
     */
    private static function getBonitaServerURL()
    {
        return config('services.bonita.api_url');
    }

    /**
     * Do a request.
     *
     * @param  string $jsessionid
     * @return mixed
     */
    public static function doTheRequest(string $endpointName, $jsessionid)
    {
        $response = Http::withHeaders([
            'Cookie' => 'JSESSIONID=' . $jsessionid
        ])->get(Self::getBonitaServerURL() . $endpointName);

        return $response->json();
    }
}

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
     * @param  string $xBonitaAPIToken
     * @return mixed
     */
    public static function doTheRequest(string $endpointName, $jsessionid, $xBonitaAPIToken)
    {
        $response = Http::withHeaders([
            'Cookie' => 'JSESSIONID=' . $jsessionid . ';' . 'X-Bonita-API-Token=' . $xBonitaAPIToken,
            'X-Bonita-API-Token' => $xBonitaAPIToken,
        ])->get(Self::getBonitaServerURL() . $endpointName);

        return $response->json();
    }
}

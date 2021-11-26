<?php

namespace App\Helpers;

use App\Helpers\URLHelper;
use Illuminate\Support\Facades\Http;

class BonitaAdminLoginHelper
{
    /**
     * Obtener headers
     *
     */
    public static function login()
    {
        $apiLoginUrl = URLHelper::getBonitaEndpointURL('/loginservice');

        return Http::asForm()->post($apiLoginUrl, [
            'username' => config('services.bonita.admin_user'),
            'password' => config('services.bonita.admin_password'),
            'redirect' => 'false',
        ])->throw();
    }
}

<?php

namespace App\Helpers;

class CaseHelper
{
    /**
     * Get active cases data
     *
     * @param  string $jsessionid
     * @param  string $xBonitaAPIToken
     * @return array
     */
    public static function getActiveCasesData($jsessionid, $xBonitaAPIToken)
    {
        return BonitaRequestHelper::doTheRequest('/API/bpm/case?p=0', $jsessionid, $xBonitaAPIToken);
    }

    /**
     * Get archived cases data
     *
     * @param  string $jsessionid
     * @param  string $xBonitaAPIToken
     * @return array
     */
    public static function getArchivedCasesData($jsessionid, $xBonitaAPIToken)
    {
        return BonitaRequestHelper::doTheRequest('/API/bpm/archivedCase?p=0', $jsessionid, $xBonitaAPIToken);
    }
}

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
    public function getActiveCasesData($jsessionid, $xBonitaAPIToken)
    {
        $bonitaRequestHelper = new BonitaRequestHelper();
        return $bonitaRequestHelper->doTheRequest('/API/bpm/case?p=0', $jsessionid, $xBonitaAPIToken);
    }

    /**
     * Get archived cases data
     *
     * @param  string $jsessionid
     * @param  string $xBonitaAPIToken
     * @return array
     */
    public function getArchivedCasesData($jsessionid, $xBonitaAPIToken)
    {
        $bonitaRequestHelper = new BonitaRequestHelper();
        return $bonitaRequestHelper->doTheRequest('/API/bpm/archivedCase?p=0', $jsessionid, $xBonitaAPIToken);
    }
}

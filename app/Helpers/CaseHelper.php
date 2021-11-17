<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class CaseHelper
{
    /**
     * Add stats to case data
     *
     * @param Illuminate\Support\Collection $bonitaData
     * @return mixed
     */
    private static function addStatsToCaseData($bonitaData)
    {
        $dbData = DB::table('sociedades_anonimas')->select(
            'bonita_case_id',
            'cantidad_rechazos_mesa_entradas',
            'cantidad_rechazos_area_legales'
        )->whereIn('bonita_case_id', Arr::pluck($bonitaData, ['rootCaseId']))
        ->get();
        foreach ($bonitaData as &$data) {
            $data['cantidad_rechazos_mesa_entradas'] = $dbData->firstWhere('bonita_case_id', $data['rootCaseId'])->cantidad_rechazos_mesa_entradas;
            $data['cantidad_rechazos_area_legales'] = $dbData->firstWhere('bonita_case_id', $data['rootCaseId'])->cantidad_rechazos_area_legales;
        }
        return $bonitaData;
    }


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
     * Get active cases data with stats
     *
     * @param  string $jsessionid
     * @param  string $xBonitaAPIToken
     * @return array
     */
    public static function getActiveCasesDataWithStats($jsessionid, $xBonitaAPIToken)
    {
        $bonitaData = Self::getActiveCasesData($jsessionid, $xBonitaAPIToken);
        return Self::addStatsToCaseData($bonitaData);
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

    /**
     * Get archived cases data with stats
     *
     * @param  string $jsessionid
     * @param  string $xBonitaAPIToken
     * @return array
     */
    public static function getArchivedCasesDataWithStats($jsessionid, $xBonitaAPIToken)
    {
        $bonitaData = Self::getArchivedCasesData($jsessionid, $xBonitaAPIToken);
        return Self::addStatsToCaseData($bonitaData);
    }
}

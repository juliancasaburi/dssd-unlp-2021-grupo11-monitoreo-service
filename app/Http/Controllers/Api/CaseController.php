<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Client\ConnectionException;
use App\Helpers\BonitaRequestHelper;
use DateTime;

class CaseController extends Controller
{
    /**
     * Get active cases data
     *
     * @param  string $jsessionid
     * @param  string $xBonitaAPIToken
     * @return array
     */
    private function getActiveCasesData($jsessionid, $xBonitaAPIToken)
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
    private function getArchivedCasesData($jsessionid, $xBonitaAPIToken)
    {
        $bonitaRequestHelper = new BonitaRequestHelper();
        return $bonitaRequestHelper->doTheRequest('/API/bpm/archivedCase?p=0', $jsessionid, $xBonitaAPIToken);
    }

    /**
     * Get active cases.
     *
     * @OA\Post(
     *    path="/api/activeCase",
     *    summary="Get active cases",
     *    description="Get active cases",
     *    operationId="getActiveCases",
     *    tags={"auth"},
     *    @OA\Response(
     *       response=200,
     *       description="Active Cases",
     *       @OA\JsonContent(
     *          example=""
     *       )
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="401 Unauthorized",
     *       @OA\JsonContent(
     *          example={"error":"Unauthorized"}
     *       )
     *    ),
     *    @OA\Response(
     *       response=500,
     *       description="500 internal server error",
     *       @OA\JsonContent(
     *          example="500 internal server error"
     *       )
     *    ),
     * )
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActiveCases(Request $request)
    {
        try {
            return response()->json($this->getActiveCasesData(
                $request->cookie('JSESSIONID'),
                $request->cookie('X-Bonita-API-Token')
            ));
        } catch (ConnectionException $e) {
            return response()->json("500 Internal Server Error", 500);
        }
    }

    /**
     * Active cases count.
     *
     * @OA\Post(
     *    path="/api/activeCaseCount",
     *    summary="Get active cases count",
     *    description="Get active cases count",
     *    operationId="getActiveCaseCount",
     *    tags={"auth"},
     *    @OA\Response(
     *       response=200,
     *       description="Active Cases Count",
     *       @OA\JsonContent(
     *          example=""
     *       )
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="401 Unauthorized",
     *       @OA\JsonContent(
     *          example={"error":"Unauthorized"}
     *       )
     *    ),
     *    @OA\Response(
     *       response=500,
     *       description="500 internal server error",
     *       @OA\JsonContent(
     *          example="500 internal server error"
     *       )
     *    ),
     * )
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActiveCaseCount(Request $request)
    {
        try {
            return response()->json(
                count($this->getActiveCasesData(
                    $request->cookie('JSESSIONID'),
                    $request->cookie('X-Bonita-API-Token')
                ))
            );
        } catch (ConnectionException $e) {
            return response()->json("500 Internal Server Error", 500);
        }
    }

    /**
     * Get archived cases.
     *
     * @OA\Post(
     *    path="/api/archivedCase",
     *    summary="Get archived cases",
     *    description="Get archived cases",
     *    operationId="getArchivedCases",
     *    tags={"auth"},
     *    @OA\Response(
     *       response=200,
     *       description="Archived Cases",
     *       @OA\JsonContent(
     *          example=""
     *       )
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="401 Unauthorized",
     *       @OA\JsonContent(
     *          example={"error":"Unauthorized"}
     *       )
     *    ),
     *    @OA\Response(
     *       response=500,
     *       description="500 internal server error",
     *       @OA\JsonContent(
     *          example="500 internal server error"
     *       )
     *    ),
     * )
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getArchivedCases(Request $request)
    {
        try {
            return response()->json($this->getArchivedCasesData(
                $request->cookie('JSESSIONID'),
                $request->cookie('X-Bonita-API-Token')
            ));
        } catch (ConnectionException $e) {
            return response()->json("500 Internal Server Error", 500);
        }
    }

    /**
     * Archived cases count.
     *
     * @OA\Post(
     *    path="/api/archivedCaseCount",
     *    summary="Get archived cases count",
     *    description="Get archived cases count",
     *    operationId="getArchivedCaseCount",
     *    tags={"auth"},
     *    @OA\Response(
     *       response=200,
     *       description="Archived Cases Count",
     *       @OA\JsonContent(
     *          example=""
     *       )
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="401 Unauthorized",
     *       @OA\JsonContent(
     *          example={"error":"Unauthorized"}
     *       )
     *    ),
     *    @OA\Response(
     *       response=500,
     *       description="500 internal server error",
     *       @OA\JsonContent(
     *          example="500 internal server error"
     *       )
     *    ),
     * )
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getArchivedCaseCount(Request $request)
    {
        try {
            return response()->json(
                count($this->getArchivedCasesData(
                    $request->cookie('JSESSIONID'),
                    $request->cookie('X-Bonita-API-Token')
                ))
            );
        } catch (ConnectionException $e) {
            return response()->json("500 Internal Server Error", 500);
        }
    }

    /**
     * Tiempo promedio resolución.
     *
     * @OA\Post(
     *    path="/api/averageCaseTime",
     *    summary="Get average resolution time",
     *    description="Get average resolution time",
     *    operationId="getAverageCaseTime",
     *    tags={"auth"},
     *    @OA\Response(
     *       response=200,
     *       description="Average case time",
     *       @OA\JsonContent(
     *          example=""
     *       )
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="401 Unauthorized",
     *       @OA\JsonContent(
     *          example={"error":"Unauthorized"}
     *       )
     *    ),
     *    @OA\Response(
     *       response=500,
     *       description="500 internal server error",
     *       @OA\JsonContent(
     *          example="500 internal server error"
     *       )
     *    ),
     * )
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAverageCaseTime(Request $request)
    {
        $data = $this->getArchivedCasesData(
            $request->cookie('JSESSIONID'),
            $request->cookie('X-Bonita-API-Token')
        );

        $totalHours = 0;

        foreach ($data as $case) {
            $start = strtotime($case['start']);
            $end = strtotime($case['end_date']);
            //$end = strtotime((new DateTime('now'))->format('Y-m-d H:i:s')); // test
            $totalHours += abs($end - $start) / (60 * 60);
        }

        try {
            return response()->json(
                $totalHours / count($data)
            );
        } catch (ConnectionException $e) {
            return response()->json("500 Internal Server Error", 500);
        }
    }
}

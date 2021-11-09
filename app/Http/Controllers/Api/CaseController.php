<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Client\ConnectionException;
use App\Helpers\CaseHelper;

class CaseController extends Controller
{
    private $caseHelper;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->caseHelper = new CaseHelper();
    }

    /**
     * Get active cases.
     *
     * @OA\Post(
     *    path="/api/activeCase",
     *    summary="Get active cases",
     *    description="Get active cases",
     *    operationId="getActiveCases",
     *    tags={"case"},
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
            return response()->json($this->caseHelper->getActiveCasesData(
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
     *    tags={"case"},
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
                count($this->caseHelper->getActiveCasesData(
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
     *    tags={"case"},
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
            return response()->json($this->caseHelper->getArchivedCasesData(
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
     *    tags={"case"},
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
                count($this->caseHelper->getArchivedCasesData(
                    $request->cookie('JSESSIONID'),
                    $request->cookie('X-Bonita-API-Token')
                ))
            );
        } catch (ConnectionException $e) {
            return response()->json("500 Internal Server Error", 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Client\ConnectionException;
use App\Helpers\BonitaRequestHelper;

class ProcessController extends Controller
{
    /**
     * Get active processes.
     *
     * @OA\Post(
     *    path="/api/process",
     *    summary="Get processes",
     *    description="Get processes",
     *    operationId="getProcesses",
     *    tags={"process"},
     *    @OA\Response(
     *       response=200,
     *       description="Processes",
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
    public function getProcesses(Request $request)
    {
        try {
            $jsessionid = $request->cookie('JSESSIONID');
            $xBonitaAPIToken = $request->cookie('X-Bonita-API-Token');

            $bonitaRequestHelper = new BonitaRequestHelper();
            $response = $bonitaRequestHelper->doTheRequest('/API/bpm/process?p=0', $jsessionid, $xBonitaAPIToken);

            return response()->json($response);
        } catch (ConnectionException $e) {
            return response()->json("500 Internal Server Error", 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\BonitaRequestHelper;

class UserController extends Controller
{
    /**
     * Get users.
     *
     * @OA\Post(
     *    path="/api/user",
     *    summary="Get users",
     *    description="Get users",
     *    operationId="getUsers",
     *    tags={"auth"},
     *    @OA\Response(
     *       response=200,
     *       description="Users",
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
    public function getUsers(Request $request)
    {
        $jsessionid = $request->cookie('JSESSIONID');
        $xBonitaAPIToken = $request->cookie('X-Bonita-API-Token');

        $response = BonitaRequestHelper::doTheRequest('/API/identity/user?p=0', $jsessionid, $xBonitaAPIToken);

        return response()->json($response);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use App\Helpers\URLHelper;
use App\Helpers\BonitaAdminLoginHelper;

class AuthController extends Controller
{
    /**
     * Login via given credentials.
     *
     * @OA\Post(
     *    path="/api/auth/login",
     *    summary="Login",
     *    description="Login con username y password",
     *    operationId="authLogin",
     *    tags={"auth"},
     *    @OA\RequestBody(
     *       @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *             type="object", 
     *             @OA\Property(
     *                property="username",
     *                type="string",
     *             ),
     *             @OA\Property(
     *                property="password",
     *                type="string",
     *             ),
     *          ),
     *      )
     *    ),
     *    @OA\Response(
     *       response=200,
     *       description="Succesful login",
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
    public function login(Request $request)
    {
        $credentials = $request->only(['username', 'password']);

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|between:2,100',
            'password' => 'required|string|min:2',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $urlHelper = new URLHelper();
            $apiLoginUrl = $urlHelper->getBonitaEndpointURL('/loginservice');

            $bonitaAdminLoginHelper = new BonitaAdminLoginHelper();
            $bonitaAdminLoginResponse = $bonitaAdminLoginHelper->login();
            if ($bonitaAdminLoginResponse->status() != 204)
                return response()->json("500 Internal Server Error", 500);
            
            $jsessionid = $bonitaAdminLoginResponse->cookies()->toArray()[1]['Value'];
            $xBonitaAPIToken = $bonitaAdminLoginResponse->cookies()->toArray()[2]['Value'];

            $userData = Http::withHeaders([
                'Cookie' => 'JSESSIONID=' . $jsessionid . ';' . 'X-Bonita-API-Token=' . $xBonitaAPIToken,
                'X-Bonita-API-Token' => $xBonitaAPIToken,
            ])->get($urlHelper->getBonitaEndpointURL("/API/identity/user?s={$credentials['username']}&f=enabled=true"));

            $userId = head($userData->json())['id'];

            $membershipData = Http::withHeaders([
                'Cookie' => 'JSESSIONID=' . $jsessionid . ';' . 'X-Bonita-API-Token=' . $xBonitaAPIToken,
                'X-Bonita-API-Token' => $xBonitaAPIToken,
            ])->get($urlHelper->getBonitaEndpointURL("/API/identity/membership?p=0&c=10&f=user_id={$userId}&d=role_id"));

            if(head($membershipData->json())['role_id']["displayName"] != 'Admin')
                return response()->json("403 Forbidden", 403);

            $response = Http::asForm()->post($apiLoginUrl, [
                'username' => $credentials["username"],
                'password' => $credentials['password'],
                'redirect' => 'false',
            ]);
            if ($response->status() == 401)
                return response()->json("401 Unauthorized", 401);

            return $this->respondWithCookies($response->cookies()->toArray());
        } catch (ConnectionException $e) {
            return response()->json("500 Internal Server Error", 500);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @OA\Post(
     *    path="/api/auth/logout",
     *    summary="Logout",
     *    description="Logout",
     *    operationId="authLogout",
     *    tags={"auth"},
     *    security={{ "apiAuth": {} }},
     *    @OA\Response(
     *       response=200,
     *       description="Success"
     *    ),
     *    @OA\Response(
     *       response=401,
     *       description="Unauthorized"
     *    ),
     * )
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            $urlHelper = new URLHelper();
            $apiUrl = $urlHelper->getBonitaEndpointURL('/logoutservice');

            $response = Http::post($apiUrl);

            if ($response->status() == 401)
                return response()->json("401 Unauthorized", 401);

            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (ConnectionException $e) {
            return response()->json("500 Internal Server Error", 500);
        }
    }


    /**
     * Send response with cookies after login
     *
     * @param  array $cookieArray
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithCookies($cookieArray)
    {
        $cookie = cookie($cookieArray[1]['Name'], $cookieArray[1]['Value'], 1440);
        $cookie2 = cookie($cookieArray[2]['Name'], $cookieArray[2]['Value'], 1440);

        return response()->json(["auth" => [
            'JSESSIONID' => $cookieArray[1]['Value'],
            'X-Bonita-API-Token' => $cookieArray[2]['Value']
        ]])->cookie($cookie)->cookie($cookie2);
    }
}

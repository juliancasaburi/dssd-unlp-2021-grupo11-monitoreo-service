<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    /**
     * Cantidad de rechazos por parte de mesa de entradas.
     *
     * @OA\Post(
     *    path="/api/stats/cantidadRechazosMesaEntradas",
     *    summary="Cantidad de rechazos por parte de mesa de entradas",
     *    description="Cantidad de rechazos por parte de mesa de entradas",
     *    operationId="getcantidadRechazosMesaEntradas",
     *    tags={"auth"},
     *    @OA\Response(
     *       response=200,
     *       description="Cantidad de rechazos por parte de mesa de entradas",
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getcantidadRechazosMesaEntradas()
    {
        return DB::table('sociedades_anonimas')->sum('cantidad_rechazos_mesa_entradas');
    }

    /**
     * Cantidad de rechazos por parte del área de legales.
     *
     * @OA\Post(
     *    path="/api/stats/cantidadRechazosLegales",
     *    summary="Cantidad de rechazos por parte de legales",
     *    description="Cantidad de rechazos por parte de legales",
     *    operationId="getcantidadRechazosLegales",
     *    tags={"auth"},
     *    @OA\Response(
     *       response=200,
     *       description="Cantidad de rechazos por parte de legales",
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getcantidadRechazosLegales()
    {
        return DB::table('sociedades_anonimas')->sum('cantidad_rechazos_area_legales');
    }
}

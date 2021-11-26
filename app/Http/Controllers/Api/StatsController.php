<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\CaseHelper;

class StatsController extends Controller
{
    /**
     * Tiempo promedio resolución.
     *
     * @OA\Post(
     *    path="/api/stats/averageCaseTime",
     *    summary="Get average resolution time (in hours)",
     *    description="Get average resolution time (in hours)",
     *    operationId="getAverageCaseTime",
     *    tags={"stats"},
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
        $data = CaseHelper::getArchivedCasesData(
            $request->cookie('JSESSIONID'),
            $request->cookie('X-Bonita-API-Token')
        );

        $totalHours = 0;

        foreach ($data as $case) {
            $start = strtotime($case['start']);
            $end = strtotime($case['end_date']);
            $totalHours += abs($end - $start) / (60 * 60);
        }

        if (!empty($data))
            return response()->json($totalHours / count($data));
        else
            return null;
    }

    /**
     * Cantidad de rechazos por parte de mesa de entradas.
     *
     * @OA\Post(
     *    path="/api/stats/cantidadRechazosMesaEntradas",
     *    summary="Cantidad de rechazos por parte de mesa de entradas",
     *    description="Cantidad de rechazos por parte de mesa de entradas",
     *    operationId="getcantidadRechazosMesaEntradas",
     *    tags={"stats"},
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
     *    tags={"stats"},
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

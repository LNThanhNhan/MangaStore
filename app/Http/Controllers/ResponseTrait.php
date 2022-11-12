<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * @param $data
     * @param  string  $message
     * @param  int $code
     * @return JsonResponse
     */
    public function successResponse($data, string $message='', int $code =200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $code);
    }

    /**
     * @param $error
     * @param  int  $code
     * @return JsonResponse
     */
    public function errorResponse($error, int $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $error,
        ], $code);
    }
}

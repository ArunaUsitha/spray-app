<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{

    /**
     * @param $data
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successResponse($data, $message = null, int $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param int $code
     * @param null $message
     * @param array $data
     * @return JsonResponse
     */
    protected function errorResponse(int $code, $message = null, array $data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param string|null $message
     * @param array $data
     * @return JsonResponse
     */
    protected function serverErrorResponse(?string $message = 'Server error', array $data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], 500);
    }



}


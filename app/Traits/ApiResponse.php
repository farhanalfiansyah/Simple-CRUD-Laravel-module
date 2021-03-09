<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait ApiResponse
{
    public function sendOk($status = 'OK', $code = 200): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'status' => $status
        ], $code);
    }

    public function sendData($data, $status = 'OK', $code = 200): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'status' => $status,
            'data' => $data
        ], $code);
    }

    public function sendError($message, $status = 'Error', $code = 400): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'status' => $status,
            'message' => $message
        ], $code);
    }

    public function handleException(Exception $e): JsonResponse
    {

        Log::error($e);

        if (env('APP_DEBUG')) {
            return $this->sendError($e->getMessage(), 'Error', 500);
        }

        return $this->sendError('Internal Server Error', 'Error', 500);
    }
}

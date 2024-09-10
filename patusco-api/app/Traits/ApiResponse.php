<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function success($data, $message = null, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function error($message, $code = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $code);
    }

    public function created($data, $message = 'Resource created successfully', $code = 201): JsonResponse
    {
        return $this->success($data, $message, $code);
    }

    public function updated($data, $message = 'Resource updated successfully', $code = 200): JsonResponse
    {
        return $this->success($data, $message, $code);
    }

    public function deleted($message = 'Resource deleted successfully', $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], $code);
    }
}

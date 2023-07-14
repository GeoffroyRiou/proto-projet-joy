<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class ApiController extends Controller
{
    /**
     * @param  array<string,mixed >  $data
     */
    protected function sendJsonResponse(bool $success, string $message, array $data = [], string $accessToken = null, int $statusCode = 200): JsonResponse
    {

        $responseBody = [
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ];

        if ($accessToken) {
            $responseBody['accessToken'] = $accessToken;
        }

        return response()->json($responseBody, $statusCode);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
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

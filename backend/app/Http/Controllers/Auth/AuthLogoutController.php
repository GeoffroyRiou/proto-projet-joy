<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthLogoutController extends AuthController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return $this->sendJsonResponse(true, 'Good bye');
    }
}

<?php

namespace App\Http\Controllers\WorkTool;

use App\Http\Controllers\ApiController;
use App\Models\WorkTool;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends ApiController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => [
                'worktools' => WorkTool::paginate(2),
            ],
        ]);
    }
}

<?php

namespace App\Http\Controllers\WorkTool;

use App\Http\Controllers\ApiController;
use App\Http\Requests\WorkTool\StoreFormRequest;
use App\Models\WorkTool;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends ApiController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreFormRequest $request): JsonResponse
    {
        $worktool = WorkTool::create([
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);

        return $this->sendJsonResponse(true, 'Worktool created', [
            'worktool' => $worktool,
        ]);
    }
}

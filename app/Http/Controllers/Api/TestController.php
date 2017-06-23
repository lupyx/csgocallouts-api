<?php

namespace App\Http\Controllers\Api;

use App\Entities\Map;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * @param int $mapId The ID of the map to get questions for
     * @return \Illuminate\Http\JsonResponse
     * Returns random questions regarding a specific map
     */
   /* public function questions(int $mapId)
    {
        return response()->json(Map::with('callouts')->get());
    }
   */
}

<?php

namespace App\Http\Controllers\Api;

use App\Entities\Map;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MapsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    /**
     * @return JsonResponse
     * Will return the information about all available maps
     */
    public function maps() : JsonResponse
    {
        return response()->json(Map::with('callouts')->get());
    }

    /**
     * @param int $id The ID of the map
     * @return JsonResponse
     * Will return information about a specific map in JSON format
     */
    public function map(int $id) : JsonResponse
    {
        $map = Map::where('id', $id)->with('callouts')->get();

        return response()->json($map);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * Will add a map to the database
     */
    public function addMap(Request $request) : JsonResponse
    {
        $this->validate($request, ['name' => 'required']);

        $map = Map::create(['name' => $request->input('name')]);

        return response()->json($map, 201);
    }
}

<?php

namespace App\Http\Controllers;

use App\Entities\Map;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\JsonResponse
     * Will return the information about all available maps
     */
    public function maps()
    {
        return response()->json(Map::with('callouts')->get());
    }

    /**
     * @param int $id The ID of the map
     * @return \Illuminate\Http\JsonResponse
     * Will return information about a specific map in JSON format
     */
    public function map(int $id)
    {
        $map = Map::where('id', $id)->with('callouts')->get();

        return response()->json($map);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Will add a map to the database
     */
    public function addMap(Request $request)
    {
        $this->validate($request, Map::$validation_rules);

        $map = Map::create(['name' => $request->input('name')]);

        return response()->json($map, 201);
    }
}

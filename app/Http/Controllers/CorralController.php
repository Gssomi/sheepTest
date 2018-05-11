<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Corral;

class CorralController extends Controller
{
    public function index() 
    {
    	return Corral::all();
    }

    public function show(Corral $corral)
    {
    	return $corral->name;
    }

    public function create(Request $request)
    {
    	$corral = Corral::create($request->all());
    	return response()->json($corral, 201);
    }

    public function update(Request $request, Corral $corrall)
    {
    	$corral->update($request->all());
    	return response()->json($corrall, 200);
    }

    public function delete(Corral $corral)
    {
    	$corral->delete();
    	return response()->json(null, 204);
    }

}

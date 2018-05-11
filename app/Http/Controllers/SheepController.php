<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sheep;
use DB;

class SheepController extends Controller
{
    public function index()
    {
    	return Sheep::all();
    }

    public function show(Sheep $sheep)
    {
    	return $sheep;
    }

    public function create()
    {
    	$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
	    $numChars = strlen($chars);
	    $name = '';
	    for ($i = 0; $i < 6; $i++) {
	      $name .= substr($chars, rand(1, $numChars) - 1, 1);
	    }

        $sheep = Sheep::create(["name" => $name, "corral_id" => rand(1, 4), "status" => 0]);
    	
    	return response()->json($sheep, 201);
    }

    public function update()
    {

    	$sheep = Sheep::inRandomOrder()
    				->where('status', 0)->first();
    	$sheep->status = -1;
    	$sheep->save();

    	return response()->json($sheep, 200);
    }

    public function logs()
    {
    	$sheeps = Sheep::all();
    	$sheepDie = [];
    	$sheepActive = [];
    	foreach ($sheeps as $sheep) {
    		if($sheep->status == -1) {
    			array_push($sheepDie, $sheep);
    		} else {
    			array_push($sheepActive, $sheep);
    		}
    	}

    	$allSheep = DB::select(DB::raw("SELECT MAX (mycount) AS maxSheep, MIN (mycount) AS minSheep FROM (SELECT COUNT(s.id) mycount FROM sheep AS s INNER JOIN corrals AS c ON s.corral_id=c.id WHERE s.status=0 GROUP BY c.name)"));
    	$corralMax = $allSheep[0]->maxSheep;
    	$corralMin = $allSheep[0]->minSheep;		

    	return view('index', ["sheepActive" => count($sheepActive), 
    						  "sheepDie" => count($sheepDie),
    						  "sheeps" => count($sheeps),
    						  "corralMax" => $corralMax,
    						  "corralMin" => $corralMin]);
    }
}

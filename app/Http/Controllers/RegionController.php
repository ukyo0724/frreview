<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Post;

class RegionController extends Controller{
    public function index(Region $region){
        return view('regions/index')->with(['posts'=>$region->getByRegion()]);
    }
    
}
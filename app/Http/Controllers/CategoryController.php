<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller{
    public function index(Category $categories){
        return view('categories/index')->with(['posts'=>$categories->getByCategory(5)]);
    }
    
}
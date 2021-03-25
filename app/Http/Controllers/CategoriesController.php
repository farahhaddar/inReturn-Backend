<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Categories::orderBy('name')->get();

        if ($category) {
            return success($category);  
        } else {
            return error(400, 'Failed to Get Categories');
        }

    }

}

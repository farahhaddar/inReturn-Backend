<?php

namespace App\Http\Controllers;



use App\Models\Cities;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = Cities::orderBy('name')->get();

        if ($city) {
            return success($city);
        } else {
            return error(400, 'Failed to Get Cities');
        }

    }
}
<?php

namespace App\Http\Controllers;

use App\Models\OfferItems;
use Illuminate\Http\Request;

class OfferItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $item = new OfferItems();
        
        $item->item_id=$data["item_id"];
        $item->exchange_id=$data["exchange_id"];
       
        if ($item->save()) {
            return success($item);
        } else {
            return error(400, "Fail To Store Items");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfferItems  $offerItems
     * @return \Illuminate\Http\Response
     */
    public function show(OfferItems $offerItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfferItems  $offerItems
     * @return \Illuminate\Http\Response
     */
    public function edit(OfferItems $offerItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfferItems  $offerItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfferItems $offerItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfferItems  $offerItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfferItems $offerItems)
    {
        //
    }
}

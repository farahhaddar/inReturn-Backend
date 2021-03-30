<?php

namespace App\Http\Controllers;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $wishList = WishList::where('user_id',$id)->get();
        if ($wishList) {
            return success($wishList);
        } else {
            return error(400, 'Can not get item');
        }
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
        $wishList = new WishList();
        $wishList->fill($data);
        if ($wishList->save()) {
            return success($wishList);
        } else {
            return error(400, 'Can not add item');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function show(WishList $wishList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WishList $wishList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishList = WishList::where('id', $id)->delete();
        if ($wishList) {
            return success("Item has been removed  successfuly");
        } else {
            return error(400, 'Can not remove item from wishList');
        }

    }
}

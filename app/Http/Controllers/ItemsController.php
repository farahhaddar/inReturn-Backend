<?php

namespace App\Http\Controllers;

use App\Models\ItemExchangeCatgories;
use App\Models\ItemImages;
use App\Models\Items;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Items::with('itemWishList', 'users', 'images', 'categoryExchange', 'category', 'offers')->get();
        if ($item) {
            return success($item);
        } else {
            return error(400, 'Failed to Get items');
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
        $item = new Items();
        $item->fill($data);
        $date = Carbon::now()->format('Y-m-d');
        $item->date = $date;
        if ($item->save()) {
            $id = $item->id;
            $images = $request->file('images');
            if ($images) {
                foreach ($images as $image) {
                $path = storeImage($images);
                if (!$path) {
                    self::destroy($id);
                    return error(400, "Couldn't upload image");
                }

                ItemImages::create([
                    'image' => $path,
                    'item_id' => $id,
                ]);

                }

                $exchangeCats = $request->exchangeCats;
                
                if ($exchangeCats) {

                    foreach ($exchangeCats as $cat) {

                    ItemExchangeCatgories::create([
                        'item_id' => $id,
                        'category_id' => $exchangeCats,
                    ]);
                 }

                    return self::show($id);

                } else {
                    self::destroy($id);
                    return error(400, "Failed To Store Exchange Categories");

                }

            } else {
                self::destroy($id);
                return error(400, "Failed To Store Images");
            }

        } else {
            return error(400, "Fail To Store Item");
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $item = Items::where('id', $id)->with('itemWishList', 'users', 'images', 'categoryExchange', 'category', 'offers')->first();
        if ($item) {
            return success($item);
        } else {
            return error(400, 'Failed to Get item');
        }

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Items::where('id', $id)->delete();
        dd($item);
        $image = $item->image;
        destroyImage($image);
        if ($item) {
            return success("Item has been deleted successfuly");
        } else {
            return error(400, 'Can not delete item');
        }

    }
}

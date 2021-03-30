<?php

namespace App\Http\Controllers;

use App\Models\ItemExchangeCatgories;
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

        $searchCat = $searchName = "";

        if (isset($_GET['catId'])) {
            $searchCat = $_GET['catId'];
        }

        if (isset($_GET['name'])) {
            $searchName = $_GET['name'];
        }

        if ($searchCat == "") {

            $item = Items::where('name', 'LIKE', '%' . $searchName . '%')
                ->with('itemWishList', 'users', 'categoryExchange', 'category', 'offers')->get();

            if ($item) {
                return success($item);
            } else {
                return error(400, 'Failed to Get items');
            }

        } else {
            if ($searchCat == 5) {
                $item = Items::
                    where('name', 'LIKE', '%' . $searchName . '%')
                    ->with('itemWishList', 'users', 'categoryExchange', 'category', 'offers')->get();
                if ($item) {
                    return success($item);
                } else {
                    return error(400, 'Failed to Get items');
                }

            }

            $item = Items::
                where('category_id', $searchCat)
                ->where('name', 'LIKE', '%' . $searchName . '%')
                ->with('itemWishList', 'users', 'categoryExchange', 'category', 'offers')->get();
            if ($item) {
                return success($item);
            } else {
                return error(400, 'Failed to Get items');
            }

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

        $image = $request->file('image');
        $path = storeImage($image);
        if (!$path) {
            return error(400, "Couldn't upload image");
        }

        $item->fill($data);
        $item->image = $path;
        $date = Carbon::now()->format('Y-m-d');
        $item->date = $date;

        if ($item->save()) {
            $id = $item->id;

            $exchangeCats = $request->exchangeCats;

            if ($exchangeCats) {

            // foreach ($exchangeCats as $cat) {
            ItemExchangeCatgories::create([
                'item_id' => $id,
                'category_id' => $exchangeCats,
            ]);
            // }

            return self::show($id);

            } else {
                self::destroy($id);
                return error(400, " Exchange Categories are required");

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
        $item = Items::where('id', $id)->with('itemWishList', 'users', 'categoryExchange', 'category', 'offers')->first();
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
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $oldData = Items::findOrFail($id);
        $item = $oldData;
        $image = $request->file('images');
        $path = updateImage($image, $old_path);
        if (!$path) {
            return error(400, "Couldn't upload image");
        }
        $item->update($data);
        $item->image = $path;
        $item->date = $oldData->date;

        if ($item->save()) {
            $id = $item->id;
            $exchangeCats = $request->exchangeCats;

            if ($exchangeCats) {

                $item->categoryExchange()->sync($exchangeCats);

            } else {
                self::destroy($id);
                return error(400, " Exchange Categories are required");

            }

        } else {
            return error(400, "Fail To Store Item");
        }

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
        $image = $item->image;
        destroyImage($image);
        if ($item) {
            return success("Item has been deleted successfuly");
        } else {
            return error(400, 'Can not delete item');
        }

    }
}

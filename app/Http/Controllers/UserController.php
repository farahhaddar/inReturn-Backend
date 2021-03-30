<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with("city","items","userWishList")->get();

        if ($users) {
            return success($users);
        } else {
            return error(400, 'Failed to Get Users');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        if ($request->validator->fails()) {
            return error(400, $request->validator->messages());
        }

        $data = $request->all();
        $image = $request->file('image');
        $path = storeImage($image);
        if (!$path) {
            return error(400, "Couldn't upload image");
        }
        $user = new User();
        $user->fill($data);
        $user->image = $path;
        if ($user->save()) {
            return success($user);
        } else {
            return error(400, 'Could Not Store User');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)
        ->with("city", "items", "userWishList")->first();

        
        if ($user) {
            return success($user);
        } else {
            return error(400, 'Failed to Get User');
        }

    }

    /**
     * count all users.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */

    public function count()
    {
        $users = User::count();
        if ($users) {
            return success($users);
        } else {
            return error(400, 'Could Not Count User');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if ($request->validator->fails()) {
            return error(400, $request->validator->messages());
        }

        $data = $request->all();
        $image = $request->file('image');
        $oldData = User::findOrFail($id);
        $old_path = $oldData->image;
        $path = updateImage($image, $old_path);
        if ($path) {
            if (trim($request->password) === '') {
                $user = $oldData;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->email = $data['phoneNb'];
                $user->email = $data['address'];
                $user->email = $data['extraInfo'];
            } else {
                $password = $request->password;
                $user = $oldData;
                $user->update($data);
                $user->password = $password;
            }
            $user->image = $path;
            if ($user->save()) {
                return success($user);
            } else {
                return error(400, 'Could Not Update User');
            }

        } else {
            return error(400, "Failed  To Upload the image");
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $image = $user->image;
        destroyImage($image);
        if ($user->delete()) {
            return success("Your account has been deleted successfuly");
        } else {
            return error(400, 'Can not delete user');
        }

    }

}

<?php

namespace App\Http\Controllers;
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
        $users=User::all();

       return response()->json(['status'=> 200, 'users' =>$users ]);


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
            $image = $request->file('image');
            $path =storeImage($image);
             if (!$path)
             {
            //  return Response::error(400, "Couldn't upload image");
             }
                $user = new User();
                $user->fill($data);
                $user->image = $path;
                $user->save();
                return response()->json(['status' => 200, 'user' => $user]);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('id', $id)->first();

    }

    public function count()
    {
        return User::count();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $data = $request->all();
            $image = $request->file('image');
            $oldData = User::findOrFail($id);
            $old_path = $oldData->image;
            $path =updateImage($image,$old_path);
            if ($path){
            if (trim($request->password) === '') {
                $user = $oldData ;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->email = $data['phoneNb'];
                $user->email = $data['address'];
                $user->email = $data['extraInfo'];
            } else {
                $password = $request->password;
                $user = $oldData ;
                $user->update($data);
                $user->password =$password;
            }
            $user->image = $path;
            $user->save();

            return response()->json(['status' => 200, 'user' => $user]);

            
        }else{
        return('fail');
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
        $user->delete();
        return response()->json(['status' => 200, 'Message' => "Record has been deleted successfuly"]);

    }


}

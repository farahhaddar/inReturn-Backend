<?php

use Illuminate\Support\Facades\Storage;

// File Handle  Functions

function storeImage($file)
{
    $path = Storage::disk('public')->put('images', $file);
    return $path;
}

function updateImage($file, $old_path)
{

    if (!empty($file)) {
        $path = Storage::disk('public')->put('images', $file);
        if ($path) {
            destroyImage($old_path);
        }

    } else {
        $path = $old_path;
    }

    return $path;
}

function destroyImage($old_path)
{
    if ($old_path !== 'images/defult.jpeg') {
        Storage::disk('public')->delete('/' . $old_path);
    }
}


// Response Handle Functions

 function success($data)
    {
        if ($data != null) {
            $response = ['status' => 200, 'success' => true,'data'=> $data];
        } else {
            $response = ['status' => 200, 'success' => true];
        }
        return response()->json($response);
    }

    function error($status, $message, $reason = null)
    {
        $error = ['status' => $status, 'message' => $message, 'reason' => $reason];
        $response = ['success' => false, 'error' => $error];
        return response()->json($response,$status);
    }

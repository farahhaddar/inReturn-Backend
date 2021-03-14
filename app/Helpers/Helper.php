<?php

use Illuminate\Support\Facades\Storage;

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

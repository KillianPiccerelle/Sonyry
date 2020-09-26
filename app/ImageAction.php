<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageAction extends Model
{
    public function store($image,$folder){

        $imageFullName = $image->getClientOriginalName();
        $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $file = time() . '_' . $imageName . '.' . $extension;
        $image->storeAs('public/'.$folder.'/' . Auth::user()->id, $file);

        return $file;
    }

    public function deleteImage($image)
    {
        if (Storage::exists($image)) {
            Storage::delete($image);
        }

    }
}

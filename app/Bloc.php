<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Bloc extends Model
{
    public function page(){
        return $this->belongsTo('App\Page');
    }
    //type text function
    public function text(){
        return $this->type = 'text';
    }

    public function script(){
        return $this->type = 'script';
    }

    public function image(){
        return $this->type = 'image';
    }

    public function video(){
        return $this->type = 'video';
    }

    public function file()
    {
        return $this->type = 'file';
    }

    public static function deleteFromStorage(Bloc $bloc){
        $path = 'public/bloc/'.$bloc->page_id;
        if (Storage::exists($path)) {
            Storage::deleteDirectory($path);
        }
    }
}

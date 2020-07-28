<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionPage extends Model
{
    public function page(){
        return $this->belongsTo('App\Page');
    }

    public function collection(){
        return $this->belongsTo('App\Collection');
    }


}

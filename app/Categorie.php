<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{

    public function topics()
    {

        return $this->hasMany('App\Topic');
    }
}

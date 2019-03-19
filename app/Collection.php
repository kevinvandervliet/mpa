<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function tasks() {
       return $this->hasMany("App\Task");
    }
}

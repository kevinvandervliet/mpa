<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function collections() {
       return $this->belongsTo("App\Collection");
    }
}

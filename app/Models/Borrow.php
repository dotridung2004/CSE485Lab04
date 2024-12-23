<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    public function borrows(){
        return $this->hasMany(Books::class);
    }
}

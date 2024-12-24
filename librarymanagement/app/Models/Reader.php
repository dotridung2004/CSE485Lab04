<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    public function books(){
        return $this->belongsTo(Book::class);
    }
    public function reader(){
        return $this->belongsTo(Reader::class);
    }
    protected $fillable = [
        'name',
        'birthday',
        'address',
        'phone'
    ];
}
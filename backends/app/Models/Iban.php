<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iban extends Model
{
    protected $fillable = ['iban', 'user_id'];

    // public function user() {
    //     return $this->belongsTo(User::class);
    // }
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public function message(){
        $this->belongsTo(Chat::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }
}

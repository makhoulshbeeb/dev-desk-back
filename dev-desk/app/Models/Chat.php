<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    public function user1()
    {
        $this->belongsTo(User::class,'user_id_1');
    }
    public function user2()
    {
        $this->belongsTo(User::class,'user_id_2');
    }

    public function hasmessage(){
        $this->hasMany(Message::class);
    }

}

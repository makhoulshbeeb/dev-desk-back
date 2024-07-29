<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    public function user1()
    {
        return $this->belongsTo(User::class,'username_1');
    }
    public function user2()
    {
        return $this->belongsTo(User::class,'username_2');
    }

    public function hasmessage(){
        return $this->hasMany(Message::class);
    }
    protected $fillable = [
        'username_1',
        'username_2',
    ];

}

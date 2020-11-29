<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'user_id',
        'message',
        'send_date',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function chat(){
        return $this->belongsTo(Chats::class,'chat_id');
    }
}

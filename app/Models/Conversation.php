<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;


    public function emplooyer(){
        return $this->belongsTo(User::class, 'emplooyer_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'conversation_id');
    }
}

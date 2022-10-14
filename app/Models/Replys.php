<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replys extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function comment(){
        return $this->belongsTo(Comments::class, 'comment_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

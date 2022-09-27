<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Mối quan hệ một nhiều giữa post và topic
    public function topics(){
        return $this->belongsTo(Topics::class, 'topic_id');
    }

}
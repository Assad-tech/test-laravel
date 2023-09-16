<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content'
    ];

    protected static function newFactory()
{
    return PostFactory::new();
}
public function user (){
    return $this->belongsTo(User::class, 'user_id', 'id');
}
public function users (){
    return $this->belongsTo(User::class, 'user_id', 'id');
}

}

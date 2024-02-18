<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Comment extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $fillable=[
        'content',
        'user_id',
        'post_id',
        ];
    public function getByComment(int $limit_count=5){
        
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
}

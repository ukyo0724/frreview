<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $fillable=[
        'content',
        'user_id',
        'post_id',
        ];
     protected $casts = [
    'updated_at' => 'datetime:Y-m-d',
        ];
    public function updatedAt(): Attribute{
    return new Attribute(
        // アクセサ
        get: fn ($value) => Carbon::parse($value)->timezone('Asia/Tokyo')->format('Y-m-d')
    );
    }
    public function getByComment(int $limit_count=5){
        
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function is_liked_by_auth_user(){
        $user=Auth::user()->id;
        $likers=array();
        foreach($this->likes as $like){
        array_push($likers, $like->user_id);
        }
        if(in_array($user, $likers)){
            return true;
        }else{
            return false;
        }
    }
}

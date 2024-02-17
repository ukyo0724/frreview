<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable=[
        'title',
        'body',
        'city',
        'region_id',
        'user_id',
        'status',
        ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function region(){
        return $this->belongsTo(Region::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function getPaginateByLimit(int $limit_count=5){
        return $this::where('status','=',2)->with(['user', 'region'])->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    public function getPaginateComment(int $limit_count=5){
        return $this->comments()->orderBy('updated_at', 'DESC')->paginate($limit_count);
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

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
        'address',
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
    public function getPaginateByDraft(int $limit_count=5){
        return $this::where('status','=',1)->where('user_id','=',Auth::user()->id)->with(['user', 'region'])->orderBy('updated_at', 'DESC')->paginate($limit_count);
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
    public function getByCategory(int $limit_count=5){
        return $this->posts()->with('categories')->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
    public function mb_wordwrap($string, $width=75, $break="\n", $cut = false) {
    if (!$cut) {
        $regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.',}\b#U';
    } else {
        $regexp = '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){'.$width.'}#';
    }
    $string_length = mb_strlen($string,'UTF-8');
    $cut_length = ceil($string_length / $width);
    $i = 1;
    $return = '';
    while ($i < $cut_length) {
        preg_match($regexp, $string, $matches);
        $new_string = (!$matches ? $string : $matches[0]);
        $return .= $new_string.$break;
        $string = substr($string, strlen($new_string));
        $i++;
    }
    return $return.$string;
    }
}


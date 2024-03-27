<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function getByRegion(int $limit_count=5){
        return  $this->posts()->where('status','=',2)->with('region')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}

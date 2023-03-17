<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];    //  everything is fillable except...
//    protected $fillable = ['title', 'excerpt', 'body']; //  id is optional and if it is added, inserted value will be set

    public function category(){
        return $this->belongsTo(Category::class);
    }
}

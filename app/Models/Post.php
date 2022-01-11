<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function getTitleAttribute($value){
        return Str::words($value,5);
    }

    public function getShowCreatedAtAttribute(){
        return '<p class="small mb-0">
                   <i class="fas fa-calendar"></i>
                   '.$this->created_at->format('d m Y').'
               </p>
               <p class="small mb-0">
                   <i class="fas fa-clock"></i>
                   '.$this->created_at->format('h i a').'
               </p>';
    }

    public function setSlugAttribute($value){
        return $this->attributes['slug']=Str::slug($value);
    }
}

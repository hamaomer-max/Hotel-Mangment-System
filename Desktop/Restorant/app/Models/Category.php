<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends  = ['full_path_image', 'crated_at_readable'];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sub_categories(){
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function getCratedAtReadableAttribute(){
        return $this->created_at?->diffForHumans();
    }

    public function getFullPathImageAttribute(){
        return env('APP_URL').'categoris-image/'. $this->image;
    }
}

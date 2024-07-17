<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function foods(){
        return $this->hasMany(Food::class,'sub_category_id');
    }

    protected $appends  = ['full_path_image', 'crated_at_readable'];

    public function getCratedAtReadableAttribute(){
        return $this->created_at?->diffForHumans();
    }

    public function getFullPathImageAttribute(){
        return env('APP_URL').'../categoris-image/'. $this->image;
    }
}

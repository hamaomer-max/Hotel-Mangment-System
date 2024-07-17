<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class , 'sub_category_id');
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    protected $appends  = ['crated_at_readable'];

    public function getCratedAtReadableAttribute(){
        return $this->created_at?->diffForHumans();
    }

}

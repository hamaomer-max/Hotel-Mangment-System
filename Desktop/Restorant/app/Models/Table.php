<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    
    protected $guarded = [];
    protected $appends  = [ 'crated_at_readable'];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCratedAtReadableAttribute(){
        return $this->created_at?->diffForHumans();
    }

}

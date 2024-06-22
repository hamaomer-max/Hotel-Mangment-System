<?php 

namespace App\Traits;

use Illuminate\Http\Request;


trait DeleteFile{

    public function DeleteFile($file_path){
            if (file_exists($file_path)) {
                unlink($file_path);
            }

    }
}
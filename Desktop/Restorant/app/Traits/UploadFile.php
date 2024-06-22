<?php 

namespace App\Traits;

use Illuminate\Http\Request;


trait UploadFile{

    public function uploadFile(Request $request,$name,$folder_name){
        $name_of_file = $request->file($name)->hashName();
        $request->file($name)->move($folder_name, $name_of_file);

        return $name_of_file;

    }
}
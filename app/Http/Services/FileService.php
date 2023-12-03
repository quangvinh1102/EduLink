<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class FileService {

    public function uploadImage($file, $nameFolder, $name){
        $nameFolder = 'public/'.$nameFolder;
        if(!Storage::exists($nameFolder)){
            Storage::makeDirectory($nameFolder);
        }

        $path = Storage::putFileAs($nameFolder, $file, $name, 'public');
        return $path;
    }
}
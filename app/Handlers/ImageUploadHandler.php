<?php

namespace App\Handlers;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUploadHandler{
    static public function save($file, $folder, $max_width = false){
        $allowed_extension = ['jpeg', 'git', 'jpg', 'png'];

        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());
        $upload_path = public_path() . '/' . $folder_name;
        $extension = strtolower($file->getClientOriginalExtension());

        if( !in_array($extension, $allowed_extension) ){
            return false;
        }

        $file_name = time() . '.' . $extension;

        $file->move($upload_path, $file_name);

        if($max_width && $extension != 'gif'){
            $image = Image::make($upload_path . '/' . $file_name);

            $image->resize($max_width, null, function ($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $image->save();
        }

        return [
            'path' => config('app.url') . "/$folder_name/$file_name"
        ];
    }
}

<?php

namespace App\Handlers;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUploadHandler
{
    /**
     * the allowable extension of files
     * 
     * @var array
     */
    private $allowedExtension = [
        "png",
        "jpg",
        "gif",
        "jpeg"
    ];


    public function save($file, $folder, $file_prefix, $maxWidth = false)
    {
        // build folder rules for storage
        $folderName = "uploads/images/$folder/" . date("Ym/d", time());

        $uploadPath = public_path() . '/' . $folderName;

        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $fileName = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        if (! in_array($extension, $this->allowedExtension)) {
            return false;
        }

        $file->move($uploadPath, $fileName);

        if ($maxWidth && $extension != 'gif') {
            $this->reduceSize($uploadPath . '/' . $fileName, $maxWidth);
        }

        return [
            'path' => config('app.url') . "/$folderName/$fileName"
        ];
    }

    protected function reduceSize($filePath, $maxWidth)
    {
        $image = Image::make($filePath);

        $image->resize($maxWidth, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->save();
    }
}
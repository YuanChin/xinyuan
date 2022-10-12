<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHandler
{
    /**
     * Store an instance of the Storage Class.
     *
     * @var Storage
     */
    private $disk;

    /**
     * Store the image that was uploaded.
     *
     * @var mixed
     */
    private $image;

    /**
     * Store the relative path that the image will be uploaded.
     *
     * @var string
     */
    private $pathOfTheRelativeFolder;

    /**
     * Store the user id of the user making the request.
     *
     * @var int|string
     */
    private $user_id;

    /**
     * Store the allowed extension.
     *
     * @var array<string>
     */
    private $allowedExtension = [
        "png", "jpg", "gif", "jpeg"
    ];


    /**
     * Create a new handler instance.
     *
     * @param string $disk
     * @param string $root
     */
    public function __construct(string $disk = 'images')
    {
        $this->disk = Storage::disk($disk);
    }

    /**
     * Store something about the information of the uploaded image.
     * 
     * @param $image
     * @param string $user_id
     * @param string $folderName
     * @return $this
     */
    public function setInformationOfTheUploadedImage(
        $image,
        string $user_id,
        string $folder
    )
    {
        $this->image = $image;
        $this->user_id = $user_id;
        $this->pathOfTheRelativeFolder = "{$this->user_id}/{$folder}";
        
        return $this;
    }

    /**
     * The uploaded image will be saved to specified path.
     *
     * @return array
     */
    public function save()
    {
        $relativeFolder = $this->getPathOfTheRelativeFolder();
        $name           = $this->getNameOfTheImage();
        $relativePath   = "{$relativeFolder}/{$name}";

        if (!$this->isImage()) {
            return [
                'success'  => false,
                'message'  => '您上傳的不是圖片'
            ];
        }
        
        $this->disk->putFileAs($relativeFolder, $this->image, $name); 

        return [
            'success' => true,
            'message' => '圖片上傳成功！',
            'path'    => $relativePath,
            'url'     => $this->getUrl($relativePath)
        ];
    }

    /**
     * Get the relative path that the image will be uploaded.
     *
     * @return string
     */
    private function getPathOfTheRelativeFolder()
    {
        return $this->pathOfTheRelativeFolder;
    }

    /**
     * Generate the name of the image.
     *
     * @return string
     */
    private function generateNameOfTheImage()
    {
        return $this->user_id . '_' . time() . '_' . Str::random(10);
    }

    /**
     * Get the name of the image.
     *
     * @return string
     */
    private function getNameOfTheImage()
    {
        $name = $this->generateNameOfTheImage();
        $extension = $this->getExtensionOfTheUploadedImage();

        return $name . '.' . $extension;
    }

    /**
     * Get the extension of the uploaded image.
     *
     * @return string
     */
    private function getExtensionOfTheUploadedImage(): string
    {
        return strtolower($this->image->extension()) ?? 'png';
    }

    /**
     * Determine if the uploaded file is the image file.
     *
     * @return boolean
     */
    private function isImage()
    {
        $extensionOfTheUploadedImage = $this->getExtensionOfTheUploadedImage();

        if (!in_array($extensionOfTheUploadedImage, $this->allowedExtension)) {
            return false;
        }

        return true;
    }

    /**
     * Delete the specified image file.
     *
     * @param string $path
     * @return bool
     */
    public function destroy(string $path)
    {
        return $this->disk->delete($path);
    }

    /**
     * Get the specified image's url.
     *
     * @param string $path
     * @return string
     */
    public function getUrl(string $path)
    {
        return $this->disk->url($path);
    }
}
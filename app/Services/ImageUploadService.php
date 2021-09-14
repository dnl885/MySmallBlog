<?php

namespace App\Services;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadService
{
    public function uploadImage(UploadedFile $file, string $dir){
        $filename = uniqid('p_', true).'.'.$file->guessExtension();

        $path = $file->storeAs($dir,$filename,'public_uploads');

        return $path;
    }
}

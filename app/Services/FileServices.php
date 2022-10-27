<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class FileServices
 * @package App\Services
 */
class FileServices
{
    /**
     * @param $html
     * @param $data
     * @return \Barryvdh\DomPDF\PDF
     */
    public function createPDF($html, $data){
        return Pdf::loadView($html, $data);
    }

    /**
     * @param $width
     * @param $image
     * @param $path
     * @param $imageFileName
     * @param string $repo
     * @return string
     */
    public function savePhoto($width,$image, $path, $imageFileName, $repo = 'public')
    {
        $img=Image::make($image)->resize($width, $width, function ($constraint) {
            $constraint->aspectRatio();
        })->response();
        $publicDisk = Storage::disk($repo);
        $filePath = $path . '/' . $imageFileName;
        $publicDisk->put($filePath, $img->getContent(), 'public');

        return $filePath;
    }
}

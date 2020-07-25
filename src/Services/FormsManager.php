<?php


namespace App\Services;


use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FormsManager
{
    static function handleFileUpload($file,String $path) {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = uniqid().'.'.'png';
        try {
            $file->move(
                $path,
                $newFilename
            );
        } catch (FileException $e) {}
        return $newFilename;
    }
    static function handlePdfUpload($file,String $path) {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = uniqid().'.'.'pdf';
        try {
            $file->move(
                $path,
                $newFilename
            );
        } catch (FileException $e) {}
        return $newFilename;
    }
}
<?php

namespace App\Services\Upload;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;


class UploadService
{
    protected $rootPath;

    public function __construct()
    {
        $this->rootPath = public_path();
    }

    public function saveFile($file, $path, $prefixName = '')
    {        
        $extension = $file->getClientOriginalExtension();
        $uniqid = uniqid('', false);
        // $filename = $prefixName != '' ? $prefixName.'_'.$uniqid.'.'.$extension : $uniqid.'.'.$extension;
        $filename = $prefixName != '' ? $prefixName : $uniqid.'.'.$extension;
        
        $path = '/'.$path.'/';
        $originalPath = $this->rootPath.$path;

        if (!file_exists($originalPath)) {
            if (!mkdir($originalPath, 0777, true) && !is_dir($originalPath)) {
                throw new Exception(sprintf('Directory "%s" was not created', $originalPath));
            }
        }

        $file->move($originalPath, $filename);

        return [
            'name' => $filename,
            'path' => $path,
            'base_path' => $this->rootPath,
            'full_path' => $originalPath.$filename,
        ];
    }

  

}

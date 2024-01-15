<?php
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


function uploadImage(UploadedFile $file, $destination)
{
    if ($file->isValid()) {
        $path = $file->store($destination, 'public');
        return Storage::url($path);
    }
    return null;
}

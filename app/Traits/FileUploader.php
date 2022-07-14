<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploader
{

    public function uploadFiles(array $files, $dir = 'avatar'): array
    {
        $paths = [];
        if ($files) {
            foreach ($files as $file) {
                $path = 'files/' . $dir . '/' . Str::uuid() . time() . '.' . $file->getClientOriginalExtension();
                $resource = File::get($file);
                Storage::disk('public')->put($path, $resource);
                $paths[] = Storage::url($path);
            }
        }
        return $paths;
    }

    public function uploadFile($file, $dir = 'avatar'): ?string
    {

        if ($file) {
            $path = 'files/' . $dir . '/' . Str::uuid() . time() . '.' . $file->getClientOriginalExtension();
            $resource = File::get($file);
            Storage::disk('public')->put($path, $resource);
            return Storage::url($path);

        }
        return null;
    }
}

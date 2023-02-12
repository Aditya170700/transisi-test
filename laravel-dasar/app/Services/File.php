<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class File
{
    public static function upload($file, $path, $isBase64 = false)
    {
        if ($isBase64) {
            $path = str_replace('_', '-', $path) . '/';
            $file = base64_decode(str_replace('base64,', '', explode(';', $file)[1]), true);
            $name = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 15) . '.webp';

            Storage::disk(env('STORAGE', 'local'))->put('/' . $path . $name, $file);

            return 'storage/' . $path . $name;
        } else {
            $path    = str_replace('_', '-', $path);
            $ext     = $file->getClientOriginalExtension();
            $newFile = Storage::disk(env('STORAGE', 'local'))->put('public/' . $path, $file);
            $arr     = explode('/', $newFile);

            return 'storage/' . $path . '/' . end($arr);
        }
    }

    public static function destroy($path)
    {
        return unlink(public_path($path));
    }
}

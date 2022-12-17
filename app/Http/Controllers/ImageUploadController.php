<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUploadController extends Controller
{
    public function upload(ImageRequest $request)
    {
        $file = $request->file('image');
        $name = Str::random(6);
        $resize = Image::make($file)->fit(300)->encode('jpg', 80);
        $path = "images/{$name}.jpg";
        $resize->save(public_path($path));

        return [
            'url' => env('APP_URL') . '/' . $path,
        ];
    }
}

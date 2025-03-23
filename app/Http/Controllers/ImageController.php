<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    public function show($filename)
    {
        $path = storage_path('app/public/images/' . $filename);
        // Check if the file exists
        if (!$path) {
            return response()->json(['error' => 'Image not found'], 404);
        }

        // Return the image URL
        $url = Storage::url('public/images/' . $filename);
        return response()->json(['url' => $url]);
    }
}

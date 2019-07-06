<?php

namespace App\Http\Controllers\Files;

use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function show(File $file)
    {
        if (!$file->visible()) {
            return abort(404);
        }

        $uploads = $file->uploads()->approved()->get();
        return view('files.show', [
            'file'    => $file,
            'uploads' => $uploads
        ]);
    }
}

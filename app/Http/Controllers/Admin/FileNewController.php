<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileNewController extends Controller
{
    public function index()
    {

        $files = File::unapproved()->finished()->oldest()->get();
        return view('admin.files.new.index',[
            'files' => $files
        ]);
    }    

    public function update(File $file)
    {
        return back()->withSuccess("{ $file->title } has been approved");
    }

    public function destroy()
    {
        
    }
}

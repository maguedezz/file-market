<?php

namespace App\Http\Controllers\Upload;
use App\File;
use App\Http\Controllers\Controller;
use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Storage;

class UploadController extends Controller
{
    public function __contruct()
    {
        $this->middleware(['auth']);
    }
    
    public function store(File $file, Request $request)
    {
        $this->authorize('touch', $file);

        $uploadedFile = $request->file('file');

        $upload = $this->storeUpload($file, $uploadedFile);

        Storage::disk('local')->putFileAs(
            'files/' . $file->identifier,
            $uploadedFile,
            'test.png'
        );
        return response()->json([
            'id' => $upload->id
        ]);
    }

     public function destroy(File $file, Upload $upload)
    {
        $this->authorize('touch', $file);
        $this->authorize('touch', $upload);
        // auth upload
        // prevent all files from being deleted when we are editing a file
        $upload->delete();
        return response()->json([
            'message' => 'File has been deleted'
        ]);
    }
    
    protected function storeUpload(File $file, UploadedFile $uploadedFile)
    {
        $upload = new Upload;

        $upload->fill([
            'filename' => $this->generateFilename($uploadedFile),
            'size' => $uploadedFile->getSize(),            
        ]);

        $upload->file()->associate($file);
        $upload->user()->associate(auth()->user());
        $upload->save();
        return $upload;
    }

    protected function generateFilename(UploadedFile $uploadedFile)
    {
        return $uploadedFile->getClientOriginalName();
    }
}

<?php

namespace App\Http\Controllers\Account;

use App\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\File\{StoreFileRequest, UpdateFileRequest};
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $files = auth()->user()->files()->latest()->finished()->get();
        return view('account.files.index',[
            'files' => $files
        ]);
    }

    public function edit(File $file)
    {
        $this->authorize('touch', $file); // to make sure that a user owns this even before he sees the post
        return view('account.files.edit',[
            'file'     => $file,
            'approval' => $file->approvals->first(),
        ]);
    }
    public function create(File $file)
    {  
        if(!$file->exists){
            $file = $this->createAndReturnSkeletonFile();
            return redirect()->route('account.files.create',$file);
        }
        $this->authorize('touch', $file);
        return view('account.files.create', [
            'file' => $file
        ]);
    }
    public function store(File $file, StoreFileRequest $request)
    {
       // dd($request->validated(), $request->only(['title','overview','overview_short','price']));
        $this->authorize('touch', $file);
        $file->fill($request->validated()); // == only(['title','overview','overview_short','price']))
        $file->finished = true;
        $file->save();
        // Flash msg
        return redirect()->route('account.files.index')
             ->withSuccess('Thanks, submitted for review.'); // Laravel knows that u are accessing session('success') that u wrote in flash.blade
    }

    public function update(File $file,UpdateFileRequest $request)
    {
        // request->only,validated,all,except all of them return array
        $this->authorize('touch',$file);
        $approvalProperties = $request->only(File::APPROVAL_PROPERTIES);
        if($file->needsApproval($approvalProperties)) {
            $file->createApproval($approvalProperties);
            return back()->withSuccess('Thanks , we will review your changes soon .');
        }

       // $file->update([
             $file->update($request->only(['live','price']));
            //'live' => $request->get('live',false),
            //'price' => $request->get('price')
        //]);

        return back()->withSuccess('File Updated!');
    }

    protected function createAndReturnSkeletonFile()
    {
        return auth()->user()->files()->create([
            'title'          => 'Untitled',
            'overview'       => 'None',
            'overview_short' => 'None',
            'price'           => 0,
            'finished'        => false
        ]);
    }
}

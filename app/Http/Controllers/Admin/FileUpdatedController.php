<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;
use App\Mail\Files\{FileUpdatesApproved, FileUpdatesRejected};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FileUpdatedController extends Controller
{
    public function index()
    {
        $files = File::whereHas('approvals')->oldest()->get();
        return view('admin.files.updated.index',[
            'files' => $files
        ]);
    }

    public function update(File $file)
    {
        $file->mergeApprovalProperties();
        $file->approveAllUploads();
        $file->deleteAllApprovals();
        # Merge approval properties
        # delete all approvals
        # approve all uploads

        Mail::to($file->user)->send(new FileUpdatesApproved($file));

        return back()->withSuccess("{$file->title} changes have been approved.");
    }

    public function destroy(File $file)
    {
        Mail::to($file->user)->send(new FileUpdatesRejected($file));

        $file->deleteAllApprovals();
        $file->deleteUnapprovedUploads();
        return back()->withSuccess("{$file->title} changes have been rejected.");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        return back()->withSuccess("{$file->title} changes have been approved.");
    }
}

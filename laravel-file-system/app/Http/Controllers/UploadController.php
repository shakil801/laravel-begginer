<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class UploadController extends Controller
{
    public function upload(Request $request){
        $request->validate([
            'pdf_file'  => 'required|mimes:pdf|max:2048',
        ]);
        // ফাইল সংরক্ষণ করা
        //hasFile() -> boolean
        if($request->hasFile('pdf_file')){
            $file = $request->file('pdf_file');
             // আসল ফাইল নাম পাওয়া
             $originalFileName = $file->getClientOriginalName();
            // location : storage/app/public/pdf_files/
            $path = $file->storeAs('pdf_files',$originalFileName,'public');
             // এখানে আপনি ডাটাবেসে $path সংরক্ষণ করতে পারেন।
        }

        return redirect()->back()->with('success', 'পিডিএফ ফাইল সফলভাবে আপলোড হয়েছে।');
    }
}

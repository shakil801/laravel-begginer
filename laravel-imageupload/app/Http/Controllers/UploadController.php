<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request){
        //image validate
        $request->validate([
            'image' =>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if($request->hasFile('image')){
            // random genrate file name
            // $imageName = time().'.'.$request->image->extension();
            $originalName = $request->image->getClientOriginalName();
            // store public/image directory
            $request->image->move(public_path('image'),$originalName);

            // Store the image in the storage folder
            // $path = $request->file('image')->store('public/images');
             // Save image to database or perform other actions as needed
             return back()
             ->with('success','Image uploaded successfully.')
             ->with('image', $originalName); // You can also return the image name to display it in the view
        }
        else{
            return back()->with('error','Failed to upload image.');
        }
    }
}

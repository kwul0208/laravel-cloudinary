<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\CloudinaryStorage;

class ImageController extends Controller
{
    public function index()
    {
        return view('list_image', ['images' => Image::get()]);
    }

    public function create()
    {
        return view('upload_create');
    }

    public function store(Request $request)
    {
        $image  = $request->file('image');
        $result = CloudinaryStorage::upload($image->getRealPath(), $image->getClientOriginalName()); 
        Image::create(['image' => $result]);
        return redirect()->route('images.index')->withSuccess('berhasil upload');
    }

    public function show($id)
    {
        //
    }

    public function edit(Image $image)
    {
        return view('upload_update', compact('image'));
    }


    public function destroy(Image $image)
    {   
        return $image;
        CloudinaryStorage::delete($image->image);
        $image->delete();
        return redirect()->route('images.index')->withSuccess('berhasil hapus');
    }

    public function test(Request $request, $id)
    {
        $old_img = $request->old_img;
        $image  = $request->file('image');
        
        CloudinaryStorage::delete($old_img);

        $result = CloudinaryStorage::upload($image->getRealPath(), $image->getClientOriginalName()); 

        Image::where('id', $id)->update([
            'image' => $result
        ]);

        return redirect()->route('images.index')->withSuccess('berhasil upload');
    }
}
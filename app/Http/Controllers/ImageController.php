<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function index()
    {
        $images = Image::latest()->get();

        return view('welcome', [
            'images' => $images
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png,bmp,gif',
            'title' => 'required',
        ]);

        $img = new Image();
        $img->title = $request->post('title');
        $img->image_name = $this->uploadImage($request);
        $img->save();

        return redirect('/')->with('message', 'Your image successfully uploaded!');
    }

    protected function uploadImage($request)
    {
        if ($request->hasFile('image')) {
            $i              = $request->file('image');
            $originalName   = $i->getClientOriginalName(); // include extension
            $destFolderPath = storage_path('app/public');

            if ($i->move($destFolderPath, $originalName)) {
                return $originalName;
            }
        }

        return null;
    }


}

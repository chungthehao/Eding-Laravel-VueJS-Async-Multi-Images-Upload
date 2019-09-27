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
        $img->image_storage_path = $this->uploadImage($request);
        $img->save();

        return redirect('/')->with('message', 'Your image successfully uploaded!');
    }

    protected function uploadImage($request)
    {
        if ($request->hasFile('image')) {
            $i                      = $request->file('image');
            $originalName           = $i->getClientOriginalName(); // include extension
            $ext                    = $i->getClientOriginalExtension();
            $originalNameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME); // trả về tên file ko có phần mở rộng
            $fileName               = str_slug($originalNameWithoutExt) . "_" . time() . "." . $ext;

            // Xem trong config/filesystems.php (default là local, root trỏ sẵn vô 'app' rồi)
            return $i->storeAs('public', $fileName); // Trả về name random string: public/svdG82olHR55QxTTjQmxr8yedyjS8YYsC7gce9xi.jpeg
        }

        return null;
    }

    # First approach
    /*
    protected function uploadImage($request)
    {
        if ($request->hasFile('image')) {
            $i              = $request->file('image');
            $originalName   = $i->getClientOriginalName(); // include extension
            $destFolderPath = storage_path('app/public'); // "C:\laragon\www\eding-laravel-vuejs-async-imgs-upload\storage\app/public"

            if ($i->move($destFolderPath, $originalName)) {
                return $originalName;
            }
        }

        return null;
    }
    */

}

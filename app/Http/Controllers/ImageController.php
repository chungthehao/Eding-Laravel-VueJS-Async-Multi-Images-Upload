<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getImages()
    {
        $images = Image::latest()->get();
        return response()->json($images, 200);
    }

    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpg,jpeg,png,bmp,gif',
        ]);

        $uploadedImageInfoArr = $this->uploadImages($request);

        foreach ($uploadedImageInfoArr as $uploadedImageInfo) {
            list($storagePath, $title) = $uploadedImageInfo;

            $img                     = new Image();
            $img->image_storage_path = $storagePath;
            $img->title              = $title;
            $img->save();
        }

        return response()->json([
            'uploaded' => true
        ]);
        //return redirect('/')->with('message', 'Your image(s) successfully uploaded!');
    }

    protected function uploadImages($request)
    {
        $uploadedImages = [];

        if ($request->hasFile('images')) {
            $imgs = $request->file('images');

            foreach ($imgs as $img) {
                $uploadedImages[] = $this->uploadImage($img);
            }
        }

        return $uploadedImages;
    }

    protected function uploadImage($i)
    {
        $originalName           = $i->getClientOriginalName(); // include extension
        $ext                    = $i->getClientOriginalExtension();
        $originalNameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME); // trả về tên file ko có phần mở rộng
        $fileName               = str_slug($originalNameWithoutExt) . "_" . time() . "." . $ext;

        // Xem trong config/filesystems.php (default là local, root trỏ sẵn vô 'app' rồi)
        $uploadedFilePath = $i->storeAs('public', $fileName); // Trả về name random string: public/svdG82olHR55QxTTjQmxr8yedyjS8YYsC7gce9xi.jpeg nếu dùng 'store'

        return [$uploadedFilePath, $originalNameWithoutExt];
    }

    # Second approach
    /*
    protected function uploadImage($request)
    {
        if ($request->hasFile('image')) {
            $i                      = $request->file('image');
            $originalName           = $i->getClientOriginalName(); // include extension
            $ext                    = $i->getClientOriginalExtension();
            $originalNameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME); // trả về tên file ko có phần mở rộng
            $fileName               = str_slug($originalNameWithoutExt) . "_" . time() . "." . $ext;

            // Xem trong config/filesystems.php (default là local, root trỏ sẵn vô 'app' rồi)
            return $i->storeAs('public', $fileName); // Trả về name random string: public/svdG82olHR55QxTTjQmxr8yedyjS8YYsC7gce9xi.jpeg nếu dùng 'store'
        }

        return null;
    }
    */

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

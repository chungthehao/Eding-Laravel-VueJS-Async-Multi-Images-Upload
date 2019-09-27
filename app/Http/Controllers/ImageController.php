<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png,bmp,gif',
            'title' => 'required',
        ]);

        dd('Ready to upload');
    }




}

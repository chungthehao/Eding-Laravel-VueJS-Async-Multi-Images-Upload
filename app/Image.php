<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $appends = ['link']; // Để lúc gọi API, trả về kết quả có chứa 'link' luôn

    public function getLinkAttribute()
    {
        //return '/storage/' . $this->image_name;
        return \Storage::url($this->image_storage_path);
    }

}

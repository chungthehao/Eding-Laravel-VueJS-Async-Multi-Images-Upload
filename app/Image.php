<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    public function getLinkAttribute()
    {
        return '/storage/' . $this->image_name;
    }

}

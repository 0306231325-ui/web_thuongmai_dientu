<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    protected $table = 'slideshow'; 

    protected $fillable = [
        'TieuDe',
        'HinhAnh',
        'HienThi',
        'ThuTu'
    ];

    public $timestamps = false;
}

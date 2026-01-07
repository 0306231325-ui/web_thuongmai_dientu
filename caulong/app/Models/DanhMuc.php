<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    protected $table = 'DanhMuc';
    protected $primaryKey = 'MaDanhMuc';
    public $timestamps = false;

    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'MaDanhMuc', 'MaDanhMuc');
    }
}


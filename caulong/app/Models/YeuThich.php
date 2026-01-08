<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YeuThich extends Model
{
    protected $table = 'YeuThich';
    protected $primaryKey = 'MaYeuThich';
    public $timestamps = false;

    protected $fillable = [
        'MaNguoiDung',
        'MaSanPham',
        'NgayThem'
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSanPham', 'MaSanPham');
    }
}

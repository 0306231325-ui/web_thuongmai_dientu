<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    protected $table = 'DanhGia';
    protected $primaryKey = 'MaDanhGia';
    public $timestamps = false;

    protected $fillable = [
        'MaSanPham',
        'MaNguoiDung',
        'MaDonHang',
        'SoSao',
        'BinhLuan',
        'NgayDanhGia'
    ];
}

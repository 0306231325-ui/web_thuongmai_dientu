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

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSanPham', 'MaSanPham');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaNguoiDung', 'MaNguoiDung');
    }
}

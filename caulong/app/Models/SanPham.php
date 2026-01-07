<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'SanPham';
    protected $primaryKey = 'MaSanPham';
    public $timestamps = false;

    protected $fillable = [
        'TenSanPham',
        'Slug',
        'HinhAnh',
        'MoTaChiTiet',
        'MaDanhMuc',
        'MaThuongHieu',
        'LuotXem',
        'TrangThai'
    ];

    protected $casts = [
        'TrangThai' => 'boolean',
    ];

    // ⭐ QUAN HỆ ĐÁNH GIÁ
    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'MaSanPham', 'MaSanPham');
    }

    public function bienThes()
{
    return $this->hasMany(BienTheSanPham::class, 'MaSanPham', 'MaSanPham');
}

public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'MaDanhMuc', 'MaDanhMuc');
    }

}

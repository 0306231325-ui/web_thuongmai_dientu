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
        'LuotXem'
    ];

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

    public function thuongHieu()
    {
        return $this->belongsTo(ThuongHieu::class, 'MaThuongHieu');
    }

    public function hinhAnhs()
{
    return $this->hasMany(HinhAnhSanPham::class, 'MaSanPham', 'MaSanPham');
}

public function hinhAnhChinh()
{
    return $this->hasOne(HinhAnhSanPham::class, 'MaSanPham', 'MaSanPham')
                ->where('LaAnhChinh', 1);
}



}

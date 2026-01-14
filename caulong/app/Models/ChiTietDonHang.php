<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'ChiTietDonHang';
    public $timestamps = false;

    protected $fillable = [
        'MaDonHang',
        'MaBienThe',
        'SoLuong',
        'DonGia'
    ];

    public function bienThe()
    {
        return $this->belongsTo(BienTheSanPham::class, 'MaBienThe');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    use HasFactory;
    protected $table = 'ChiTietDonHang';
    public $timestamps = false;
    public $incrementing = false; 
    protected $primaryKey = ['MaDonHang', 'MaBienThe']; 

    protected $fillable = [
        'MaDonHang',
        'MaBienThe',
        'SoLuong',
        'DonGia',
        'ThanhTien'
    ];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'MaDonHang', 'MaDonHang');
    }
    public function bienTheSanPham()
    {
        return $this->belongsTo(BienTheSanPham::class, 'MaBienThe', 'MaBienThe');
    }
}
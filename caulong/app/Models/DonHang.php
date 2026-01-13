<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    protected $table = 'DonHang';
    protected $primaryKey = 'MaDonHang';
    public $timestamps = false; 

    protected $fillable = [
        'MaNguoiDung',
        'TenNguoiNhan',
        'SoDienThoaiNguoiNhan',
        'DiaChiGiaoHang',
        'NgayDat',
        'TienHang',
        'PhiShip',
        'GiamGia',
        'TongTien',
        'MaPhuongThucTT',
        'TrangThaiThanhToan',
        'TrangThaiDonHang',
        'GhiChu'
    ];


    protected $casts = [
        'NgayDat' => 'datetime',
        'TrangThaiThanhToan' => 'boolean', 
        'TongTien' => 'decimal:2',
    ];

 
    public function chiTiet()
    {
        return $this->hasMany(ChiTietDonHang::class, 'MaDonHang', 'MaDonHang');
    }


    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaNguoiDung', 'MaNguoiDung'); 
    }


    public function phuongThucThanhToan()
    {
        return $this->belongsTo(PhuongThucThanhToan::class, 'MaPhuongThucTT', 'MaPhuongThuc');
    }
}
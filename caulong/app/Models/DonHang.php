<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'DonHang';
    protected $primaryKey = 'MaDonHang';
    public $timestamps = false;

    protected $fillable = [
        'MaNguoiDung',
        'TenNguoiNhan',
        'SoDienThoaiNguoiNhan',
        'DiaChiGiaoHang',
        'TongTien',
        'TrangThaiDonHang'
    ];

    public function chiTiet()
    {
        return $this->hasMany(ChiTietDonHang::class, 'MaDonHang');
    }
}

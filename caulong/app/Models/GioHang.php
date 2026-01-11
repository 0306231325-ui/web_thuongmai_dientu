<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;

    protected $table = 'GioHang';
    protected $primaryKey = 'MaGioHang';
    public $timestamps = false;

    protected $fillable = [
        'MaNguoiDung',
        'NgayCapNhat',
    ];

    // Một giỏ hàng có nhiều chi tiết
    public function chiTiet()
    {
        return $this->hasMany(ChiTietGioHang::class, 'MaGioHang', 'MaGioHang');
    }

    // Liên kết với người dùng
    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaNguoiDung', 'MaNguoiDung');
    }
}

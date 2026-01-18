<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    use HasFactory;
    
    protected $table = 'KhuyenMai';
    protected $primaryKey = 'MaKhuyenMai';
    public $timestamps = false;

    protected $fillable = [
        'TenChuongTrinh',
        'MaCode',
        'PhanTramGiam',
        'GiaTriGiamToiDa',
        'DonHangToiThieu',
        'NgayBatDau',
        'NgayKetThuc',
        'SoLuongSuDung',
        'TrangThai'
    ];

    protected $casts = [
        'NgayBatDau' => 'datetime',
        'NgayKetThuc' => 'datetime',
    ];

    /**
     * @param float $totalCart 
     * @return bool
     */
    public function checkDieuKien($totalCart)
    {
        return $totalCart >= $this->DonHangToiThieu;
    }
}
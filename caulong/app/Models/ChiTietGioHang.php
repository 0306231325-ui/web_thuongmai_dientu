<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    use HasFactory;

    protected $table = 'ChiTietGioHang';

    protected $primaryKey = null;

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'MaGioHang',
        'MaBienThe',
        'SoLuong',
        
    ];

  
    public function gioHang()
    {
        return $this->belongsTo(GioHang::class, 'MaGioHang', 'MaGioHang');
    }

  
    public function bienTheSanPham()
    {
        return $this->belongsTo(
            BienTheSanPham::class,
            'MaBienThe',
            'MaBienThe'
        );
    }
}
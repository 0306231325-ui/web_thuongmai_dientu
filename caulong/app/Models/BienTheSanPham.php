<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BienTheSanPham extends Model
{
    protected $table = 'BienTheSanPham';
    protected $primaryKey = 'MaBienThe';
    public $timestamps = false;

    protected $fillable = [
        'MaSanPham',
        'SKU',
        'TenBienThe',
        'GiaBan',
        'SoLuongTon',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSanPham', 'MaSanPham');
    }
}

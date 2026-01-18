<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaChiNguoiDung extends Model
{
    use HasFactory;

    protected $table = 'DiaChiNguoiDung';
    protected $primaryKey = 'MaDiaChi';
    public $timestamps = false; 

    protected $fillable = [
        'MaNguoiDung',
        'TenNguoiNhan',
        'SoDienThoai',
        'DiaChiChiTiet',
        'MacDinh'
    ];
}
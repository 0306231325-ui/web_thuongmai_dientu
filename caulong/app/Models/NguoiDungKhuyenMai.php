<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NguoiDungKhuyenMai extends Model
{
    use HasFactory;

    protected $table = 'NguoiDung_KhuyenMai'; 
    public $timestamps = false; 

    protected $fillable = [
        'MaNguoiDung',
        'MaKhuyenMai',
        'NgayLuu',
        'DaSuDung'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HinhAnhSanPham extends Model
{
    use HasFactory;

    protected $table = 'HinhAnhSanPham';
    protected $primaryKey = 'MaHinhAnh';
    public $timestamps = false;


    protected $fillable = [
        'MaSanPham',
        'DuongDan',
        'LaAnhChinh'
    ];
    

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSanPham', 'MaSanPham');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuongThucThanhToan extends Model
{
    use HasFactory;

    protected $table = 'PhuongThucThanhToan';
    protected $primaryKey = 'MaPhuongThuc';
    
    public $timestamps = false;

    protected $fillable = [
        'TenPhuongThuc',
        'TrangThai'
    ];
    
    protected $casts = [
        'TrangThai' => 'boolean',
    ];


    public function donHangs()
    {
        return $this->hasMany(DonHang::class, 'MaPhuongThucTT', 'MaPhuongThuc');
    }
}
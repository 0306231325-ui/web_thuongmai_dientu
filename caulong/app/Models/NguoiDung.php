<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\DiaChiNguoiDung;
use App\Models\KhuyenMai;

class NguoiDung extends Authenticatable
{
    use Notifiable;

    protected $table = 'NguoiDung';
    protected $primaryKey = 'MaNguoiDung';
    public $timestamps = false;


    protected $fillable = [
        'TenDangNhap',
        'MatKhau',
        'HoTen',
        'Email',
        'SoDienThoai',
        'AnhDaiDien',
        'GoogleID',
        'FacebookID',
        'TrangThai',
        'NgayTao'
    ];

    protected $hidden = [
        'MatKhau',
    ];

    
    public function getAuthPassword()
    {
        return $this->MatKhau;
    }

    
    public function danhGias(): HasMany
    {
        return $this->hasMany(
            DanhGia::class,
            'MaNguoiDung',
            'MaNguoiDung'
        );
    }

    
    public function vaiTros(): BelongsToMany 
    {
        return $this->belongsToMany(
            VaiTro::class,
            'NguoiDung_VaiTro',
            'MaNguoiDung',
            'MaVaiTro'
        );
    }

    
    public function diaChi(): HasMany
    {
        return $this->hasMany(
            DiaChiNguoiDung::class,
            'MaNguoiDung',
            'MaNguoiDung'
        );
    }

    
    public function khuyenMais(): BelongsToMany
    {
        return $this->belongsToMany(
            KhuyenMai::class,
            'NguoiDung_KhuyenMai', 
            'MaNguoiDung',         
            'MaKhuyenMai'       
        )
        ->withPivot('NgayLuu', 'DaSuDung'); 
    }
}
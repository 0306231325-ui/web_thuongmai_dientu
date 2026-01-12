<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NguoiDung extends Authenticatable
{
    use Notifiable;

    protected $table = 'NguoiDung';
    protected $primaryKey = 'MaNguoiDung';
    public $timestamps = false;

    protected $fillable = [
        'TenDangNhap',
        'MatKhau',
        'TrangThai'
    ];

    protected $hidden = [
        'MatKhau'
    ];

    /**
     * Laravel mặc định lấy cột password
     * Ta override để dùng MatKhau
     */
    public function getAuthPassword()
    {
        return $this->MatKhau;
    }

    /**
     * Quan hệ đánh giá
     */
    public function danhGias(): HasMany
    {
        return $this->hasMany(
            DanhGia::class,
            'MaNguoiDung',
            'MaNguoiDung'
        );
    }

    /**
     * Quan hệ vai trò
     */
    public function vaiTros()
    {
        return $this->belongsToMany(
            VaiTro::class,
            'NguoiDung_VaiTro',
            'MaNguoiDung',
            'MaVaiTro'
        );
    }
}

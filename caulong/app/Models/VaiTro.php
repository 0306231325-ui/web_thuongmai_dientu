<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    protected $table = 'VaiTro';
    protected $primaryKey = 'MaVaiTro';
    public $timestamps = false;

    protected $fillable = ['TenVaiTro'];

    public function nguoiDungs()
    {
        return $this->belongsToMany(
            \App\Models\NguoiDung::class,
            'NguoiDung_VaiTro',
            'MaVaiTro',
            'MaNguoiDung'
        );
    }
}

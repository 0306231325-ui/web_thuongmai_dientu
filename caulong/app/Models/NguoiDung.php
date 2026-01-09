<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NguoiDung extends Model
{
    protected $table = 'NguoiDung';
    protected $primaryKey = 'MaNguoiDung';
    public $timestamps = false;

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'MaNguoiDung', 'MaNguoiDung');
    }
}



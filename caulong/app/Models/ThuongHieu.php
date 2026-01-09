<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    protected $table = 'ThuongHieu';
    protected $primaryKey = 'MaThuongHieu';
    public $timestamps = false;

    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'MaThuongHieu');
    }
}


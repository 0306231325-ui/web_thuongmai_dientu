<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    protected $table = 'DanhMuc';
    protected $primaryKey = 'MaDanhMuc';
    public $timestamps = false;

    protected $fillable = [
        'TenDanhMuc',
        'Slug',
        'HinhAnh',
        'DanhMucCha'
    ];

    // Danh mục con
    public function children()
    {
        return $this->hasMany(DanhMuc::class, 'DanhMucCha', 'MaDanhMuc');
    }

    // Danh mục cha
    public function parent()
    {
        return $this->belongsTo(DanhMuc::class, 'DanhMucCha', 'MaDanhMuc');
    }
}

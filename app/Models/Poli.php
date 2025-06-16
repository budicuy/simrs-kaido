<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dokter;
use App\Models\Perawat;
class Poli extends Model
{
    //

    // add fillable
    protected $fillable = [
        'nama_poli',
        'id_dokter',
        'id_perawat'
    ];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];
    public function dokter()
{
    return $this->belongsTo(Dokter::class, 'id_dokter');
}

public function pendaftarans()
{
    return $this->hasMany(Pendaftaran::class, 'id_poli');
}

public function perawat()
{
    return $this->belongsTo(Perawat::class, 'id_perawat');
}
}

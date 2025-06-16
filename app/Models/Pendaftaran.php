<?php

namespace App\Models;
use App\Models\Pasiens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    //

    // add fillable
    protected $fillable = [
        'rm',
        'id_poli',
        'tgl_kunjungan',
        'no_antrian',
        'status'
    ];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasiens::class, 'rm', 'rm');
    }
public function poli() 
{
    return $this->belongsTo(Poli::class, 'id_poli');
}
    
}

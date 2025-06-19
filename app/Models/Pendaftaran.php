<?php

namespace App\Models;

use App\Models\Pasiens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    // Specify the primary key
    protected $primaryKey = 'rm';

    // Indicate that the primary key is not auto-incrementing
    public $incrementing = false;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // add fillable
    protected $fillable = [
        'rm',
        'id_poli',
        'tgl_kunjungan',
        'no_antrian',
        'status'
    ];

    // add hidden
    protected $hidden = ['created_at', 'updated_at'];

    // Add casts for proper data handling
    protected $casts = [
        'tgl_kunjungan' => 'datetime',
        'no_antrian' => 'integer',
        'rm' => 'integer',
        'id_poli' => 'integer',
    ];

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasiens::class, 'rm', 'rm');
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasiens extends Model
{
    //
    use HasFactory;

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'rm';

    // add fillable
    protected $fillable = [
        'rm',
        'nik',
        'nama_pasien',
        'tgl_lahir',
        'agama',
        'kabupaten',
        'pekerjaan',
        'jns_kelamin',
        'alamat',
        'no_hp_pasien',
        'email_pasien',
        'gol_darah'
    ];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];
    
}

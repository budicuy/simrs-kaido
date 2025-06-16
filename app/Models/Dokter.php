<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Dokter extends Model
{
    //

    // add fillable
    protected $fillable = [
        'nama_dokter',
        'no_hp_dokter',
        'id_user'
    ];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}

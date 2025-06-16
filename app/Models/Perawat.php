<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    //

    // add fillable
    protected $fillable = [
        'nama_perawat',
        'no_hp_perawat',
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

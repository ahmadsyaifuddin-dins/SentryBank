<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'no_rekening', 'nik', 'alamat',
        'tanggal_lahir', 'saldo', 'status_akun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function transfersDari()
    {
        return $this->hasMany(Transfer::class, 'dari_nasabah_id');
    }

    public function transfersKe()
    {
        return $this->hasMany(Transfer::class, 'ke_nasabah_id');
    }
}


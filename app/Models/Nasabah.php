<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_rekening',
        'nik',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'saldo',
        'status_akun',
        'kewarganegaraan',
        'no_hp',
    ];

    protected $casts = [
        'tanggal_lahir' => 'datetime',
        'saldo' => 'decimal:2',
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
    // Accessor untuk format saldo
    public function getFormattedSaldoAttribute()
    {
        return 'Rp ' . number_format($this->saldo, 0, ',', '.');
    }
}

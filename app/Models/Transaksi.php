<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'jenis_transaksi',
        'nominal',
        'saldo_sebelum',
        'saldo_sesudah',
        'keterangan',
        'tanggal_transaksi',
    ];

    public function getFormattedSaldoAttribute()
    {
        return 'Rp ' . number_format($this->nominal, 0, ',', '.');
    }
}

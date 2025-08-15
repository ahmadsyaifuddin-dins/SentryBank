<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'dari_nasabah_id',
        'ke_nasabah_id',
        'nominal',
        'keterangan',
        'waktu_transfer',
    ];

    public function getFormattedSaldoAttribute()
    {
        return 'Rp ' . number_format($this->nominal, 0, ',', '.');
    }

    public function dariNasabah()
    {
        return $this->belongsTo(Nasabah::class, 'dari_nasabah_id');
    }

    public function keNasabah()
    {
        return $this->belongsTo(Nasabah::class, 'ke_nasabah_id');
    }
}

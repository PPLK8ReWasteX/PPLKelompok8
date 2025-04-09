<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vendor;

class EcoCycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vendor_id',
        'kategori_sampah',
        'berat',
        'alamat',
        'deskripsi',
        'foto',
        'status',
        'jadwal_pengambilan', // Pastikan kolom ini ada
    ];

}    
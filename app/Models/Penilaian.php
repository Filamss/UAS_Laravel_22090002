<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaian';

    protected $fillable = ['alternatif_id', 'C1', 'C2', 'C3', 'C4', 'C5'];

    protected $casts = [
        'C1' => 'integer',
        'C2' => 'integer',
        'C3' => 'integer',
        'C4' => 'integer',
        'C5' => 'integer',
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }
}
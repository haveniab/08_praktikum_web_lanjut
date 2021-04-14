<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class MataKuliah extends Model
{
    protected $table='matakuliah';
    use HasFactory;

    public function mahasiswa()
    {
    	return $this->belongsToMany(Mahasiswa::class)->withPivot('nilai');
    }
}

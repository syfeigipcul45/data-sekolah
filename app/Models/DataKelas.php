<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    protected $fillable = [
        'sekolah_id',
        'nama_kelas',
    ];

    public function sekolah()
    {
        return $this->belongsTo(ProfilSekolah::class, 'sekolah_id');
    }

    public function hasRelatedRecords(): bool
    {
        // Add checks for each related table
        // For example, if you have a 'siswa' relationship:
        // return $this->siswa()->exists();

        // For now, returning false as we don't have any related tables yet
        // Update this method when you add related tables
        return false;
    }
}

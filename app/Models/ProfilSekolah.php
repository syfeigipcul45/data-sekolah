<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfilSekolah extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tahunAjarans(): HasMany
    {
        return $this->hasMany(TahunAjaran::class, 'sekolah_id');
    }

    protected $fillable = [
        'user_id',
        'nama_sekolah',
        'npsn',
        'alamat',
        'telepon',
        'email',
        'website',
        'kepala_sekolah',
    ];
}

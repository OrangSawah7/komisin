<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'artist_profile_id',
        'title',
        'description',
        'price',
        'category',
        'thumbnail',
        'status',
    ];

    // ini buat relasi jg cik, kalaw ini nanti 1 artist cuma bisa punya 1 katalog komisi
    public function artistProfile(){
        return $this->belongsTo(ArtistProfile::class);
    }
}

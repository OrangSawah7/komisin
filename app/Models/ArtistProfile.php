<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtistProfile extends Model
{
    // kolom2 yg boleh diisi pas pake create() ataw apdet(), ini fitur keamanan bos -> mass assignment protection
    protected $fillable = [
        'user_id',
        'display_name',
        'bio',
        'avatar',
        'instagram',
        'twitter',
    ];

    // ini buat relasi lur, profile artist dimiliki oleh 1 user, jd belongsTo
    public function user() {
        return $this->belongsTo(User::class);
    }
}

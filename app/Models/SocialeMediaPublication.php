<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialeMediaPublication extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_publication', 'id_sociale_media_types'
    ];
}

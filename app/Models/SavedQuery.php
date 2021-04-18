<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedQuery extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_from',
        'date_to',
        'pas',
        'microphones',
        'latitude',
        'longitude',
        'distance',
        'genres',
        'user_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address',
        'city',
        'latitude',
        'longitude',
        'city',
        'zipcode',
        'website',
        'telephone',
        'description',
        'coverphoto',
        'vimeo_id',
        'capacity',
        'genre_description',
        'rider',
        'pa_id',
        'genre_description',
        'email_verified_at',
    ];
    public function pa(): BelongsTo
    {
        return $this->belongsTo(Pa::class);
    }
    public function microphones(): HasMany
    {
        return $this->hasMany(MicrophonesUser::class);
    }
    public function genres(): HasMany
    {
        return $this->hasMany(GenresUser::class);
    }
    public function bandmembers(): HasMany
    {
        return $this->hasMany(Bandmember::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

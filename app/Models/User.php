<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Units of the owner
     *
     * @return Unit
     */
    public function units()
    {
        return $this->belongsToMany('App\Estate\Models\Unit', 'unit_occupancy', 'user', 'unit')
            ->withPivot(['is_primary', 'is_owner'])
            ->withTimestamps();
    }

    /**
     * User Profile
     *
     * @return Profile
     */
    public function profile()
    {
        return $this->hasOne('App\User\Models\Profile', 'user')->withTrashed();
    }
}

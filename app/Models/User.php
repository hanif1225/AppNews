<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'username',
        'no_hp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('name', 'like', '%' . $search . '%');
        });
        
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    } 

    public function postingan()
    {
        return $this->hasMany(Postingan::class);
    } 

    public function iklan()
    {
        return $this->hasMany(Iklan::class);
    } 

    public function history()
    {
        return $this->hasMany(History::class);
    } 

    public function history_rewards()
    {
        return $this->hasMany(History_Reward::class);
    } 

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    } 

    public function profil()
    {
        return $this->hasOne('App\Models\Profil_user');
    }

    public function reward()
    {
        return $this->hasOne('App\Models\Reward');
    }

    public function like()
    {
        return $this->hasOne(Like::class);
    }

    public function afiliasi()
    {
        return $this->hasOne(Afiliasi::class);
    }
    public function permintaan()
    {
        return $this->hasOne('App\Models\Permintaan');
    }

    public function statistik()
    {
        return $this->hasMany(Statistik::class);
    }
    
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    } 
    
}

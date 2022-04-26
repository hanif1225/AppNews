<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
    protected $table = 'reward';
    protected $fillable = ['user_id', 'point'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }    

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    } 

}

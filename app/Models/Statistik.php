<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    use HasFactory;
    protected $table = 'statistik';
    protected $fillable = ['user_id','tanggal','judul','postingan_id','status_iklan'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }    
}

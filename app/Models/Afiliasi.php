<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afiliasi extends Model
{
    use HasFactory;
    protected $table = 'afiliasi';
    protected $fillable = ['user_id','kode_afiliasi','kode_undangan'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }   
}

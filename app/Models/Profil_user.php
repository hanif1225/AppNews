<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil_user extends Model
{
    use HasFactory;
    protected $table = 'profil_user';

    protected $fillable = ['user_id', 'foto', 'alamat', 'tanggal_lahir', 'jenis_kelamin', 
                            'instagram', 'ktp', 'nama_rekening', 'no_rekening','status','kode_akses','permintaan'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }    
}

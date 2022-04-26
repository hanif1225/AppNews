<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_coin';
    protected $fillable = ['tanggal','pengajuan','status','nominal','user_id','reward_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    public function reward()
    {
        return $this->belongsTo(Reward::class);
    } 

}

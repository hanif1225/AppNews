<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_Reward extends Model
{
    use HasFactory;
    protected $table = 'history_rewards';
    protected $fillable = ['user_id','tanggal','aktivitas','point','slug'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }   
}

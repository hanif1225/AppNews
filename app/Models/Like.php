<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'like';
    protected $fillable = ['user_id','postingan_id'];


    public function postingan()
    {
        return $this->hasMany(Postingan::class);
    } 

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

}

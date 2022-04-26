<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class History extends Model
{
    use HasFactory;
    protected $table = 'history';
    protected $fillable = ['user_id','postingan_id','slug'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }   

    public function postingan()
    {
        return $this->belongsTo('App\Models\Postingan', 'postingan_id');
    }   
    

}

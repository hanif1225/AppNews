<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iklanads extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'iklan_ads';
    protected $fillable = ['isi','judul'];

}

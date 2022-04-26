<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;
    protected $table = 'permintaan';
    protected $fillable = ['user_id','kode_akses','permintaan','status'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => 
            $query->whereHas('user', fn($query) =>
               $query->where('name',$search)
            )
        );
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }    
}

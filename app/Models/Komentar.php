<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $table = 'komentar';
    protected $fillable = ['user_id','postingan_id','isi','status','alasan'];


    public function scopeFilter($query, array $filters)
    {
        // if(isset($filters['search']) ? $filters['search'] : false)
        // {
        //     return $query->where('judul', 'like', '%' . $filters['search'] . '%');
        // }

        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('isi', 'like', '%' . $search . '%');
        });

        $query->when($filters['postingan'] ?? false, function($query, $postingan){
            return $query->whereHas('postingan', function($query) use ($postingan) {
                $query->where('judul',$postingan);
            });
        });

        $query->when($filters['user'] ?? false, function($query, $user){
            return $query->whereHas('user', function($query) use ($user) {
                $query->where('name',$user);
            });
        });
        
    }
    
    public function postingan()
    {
        return $this->belongsTo('App\Models\Postingan', 'postingan_id');
    } 

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    } 
}

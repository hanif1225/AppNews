<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    use HasFactory;

    protected $table = 'postingan';
    protected $fillable = ['user_id','category_id','deskripsi','judul','gambar','tanggal','lokasi','isi','status','alasan','slug','views','like','trending','excerpt','iklan'];

    public function scopeFilter($query, array $filters)
    {
        // if(isset($filters['search']) ? $filters['search'] : false)
        // {
        //     return $query->where('judul', 'like', '%' . $filters['search'] . '%');
        // }

        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('judul', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('category', function($query) use ($category) {
                $query->where('slug',$category);
            });
        });

        $query->when($filters['user'] ?? false, function($query, $user){
            return $query->whereHas('user', function($query) use ($user) {
                $query->where('name',$user);
            });
        });
        
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }   

    public function iklan()
    {
        return $this->belongsTo(Iklan::class);
    }   

    public function like()
    {
        return $this->hasMany(Like::class);
    } 

    public function history()
    {
        return $this->hasMany(History::class);
    } 

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    } 



}

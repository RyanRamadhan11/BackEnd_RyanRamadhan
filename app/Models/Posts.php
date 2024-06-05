<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    //mapping ke tabel
    protected $table = 'posts';
    //mapping ke kolom/fieldnya
    protected $fillable = ['title','content','user_id','category_id'];


    //tabel relasi merujuk/merefer ke tabel master/acuan
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    //tabel relasi merujuk/merefer ke tabel master/acuan
    public function user()
    {
        return $this->belongsTo(Userss::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    //mapping ke tabel
    protected $table = 'comments';

    //mapping ke kolom/fieldnya
    protected $fillable = ['content', 'post_id', 'user_id'];

    //tabel relasi merujuk/merefer ke tabel master/acuan
    public function post()
    {
        return $this->belongsTo(Posts::class);
    }

    public function user()
    {
        return $this->belongsTo(Userss::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

    use HasFactory;
    //mapping ke tabel
    protected $table = 'categories';
    //mapping ke kolom/fieldnya
    protected $fillable = ['name'];

    //relasi one to many ke tabel menu
    public function posts()
    {
        return $this->hasMany(Posts::class);
    }
}

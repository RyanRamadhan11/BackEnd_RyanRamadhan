<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userss extends Model
{
    use HasFactory;

    //mapping ke tabel
    protected $table = 'users';
    //mapping ke kolom/fieldnya
    protected $fillable = ['email','name','password','role','isactive', 'foto', 'no_hp', 'alamat'];

}

<?php

namespace App\Exports;

use App\Models\Posts;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class PostsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Menu::all();
        $ar_menu = DB::table('posts')
        ->join('categories', 'categories.id', '=', 'posts.category_id')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('posts.title','posts.content','users.name',
                'categories.name')
        ->get();
        return $ar_menu;
    }

    public function headings(): array
    {
        return ["Title", "Content", "Nama User", "Nama Kategori"];
    }
}

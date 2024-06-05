<?php

namespace App\Exports;

use App\Models\Comments;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class CommentsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Testimoni::all();
        $ar_comments = DB::table('comments')
        ->join('users', 'users.id', '=', 'comments.user_id')
        ->join('posts', 'posts.id', '=', 'comments.post_id')
        ->select('users.name','posts.title','comments.content')
        ->get();
        return $ar_comments;
    }

    public function headings(): array
    {
        return ["Nama User", "Posts Title", "Content"];
    }
}

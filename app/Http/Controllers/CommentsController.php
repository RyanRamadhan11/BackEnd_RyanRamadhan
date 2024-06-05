<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//tambahan
use App\Models\Posts;
use App\Models\Comments;
use App\Models\Userss;
use DB;
use PDF;

//excel
use App\Exports\CommentsExport;
use App\Http\Middleware\Peran;
use Maatwebsite\Excel\Facades\Excel;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //menampilkan seluruh data
       $comments = Comments::orderBy('id', 'DESC')->get();
       return view('Comments.index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //ambil master untuk dilooping di select option
        $ar_posts = Posts::all();
        $ar_user = Userss::all();
        //arahkan ke form input data
        return view('Comments.form',compact('ar_posts','ar_user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:45',
            'post_id' => 'required|max:45',
            'user_id' => 'required|max:45',
        ],
        [
            'content.required'=>'Content Comments Wajib di Isi',
            'content.max'=>'Content Comments Maksimal 45 Karakter',
            'post_id.required'=>'Post ID Wajib di Isi',
            'post_id.max'=>'Post ID Maksimal 45 Karakter',
            'user_id.required'=>'User ID Wajib di Isi',
            'user_id.max'=>'User ID Maksimal 45 Karakter',
        ]
        );
    
        //lakukan insert data dari request form
        DB::table('comments')->insert(
            [
                'content'=>$request->content,
                'post_id'=>$request->post_id,
                'user_id'=>$request->user_id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
    
        return redirect()->route('comments.index')
                        ->with('success','Data Comments Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $row = Comments::find($id);
        return view('Comments.detail',compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = Comments::find($id);
        return view('Comments.form_edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'content' => 'required|max:45',
            'post_id' => 'required|max:45',
            'user_id' => 'required|max:45',
        ],
        [
            'content.required'=>'Content Comments Wajib di Isi',
            'content.max'=>'Content Comments Maksimal 45 Karakter',
            'post_id.required'=>'Post ID Wajib di Isi',
            'post_id.max'=>'Post ID Maksimal 45 Karakter',
            'user_id.required'=>'User ID Wajib di Isi',
            'user_id.max'=>'User ID Maksimal 45 Karakter',
        ]
        );

         //lakukan update data dari request form edit
         DB::table('comments')->where('id',$id)->update(
            [
                'content'=>$request->content,
                'post_id'=>$request->post_id,
                'user_id'=>$request->user_id,
                'updated_at'=>now(),
            ]);
    
        return redirect()->route('comments.index')
                        ->with('success','Data Comments Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //setelah itu baru hapus data pesanan
        Comments::where('id',$id)->delete();
        return redirect()->route('comments.index')
                        ->with('success','Data Comments Berhasil Dihapus');
    }

    public function commentsPDF()
    {
        $comments = Comments::all(); 
        //dd($pegawai);
        $pdf = PDF::loadView('Comments.commentsPDF',['comments'=>$comments]);
        return $pdf->download('data_comments.pdf');
    }

    public function commentsExcel() 
    {
        return Excel::download(new CommentsExport, 'data_comments.xlsx');
    }
}

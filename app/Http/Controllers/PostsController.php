<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//tambahan
use App\Models\Posts;
use App\Models\Categories;
use App\Models\Userss;
use DB;
use PDF;

//excel
use App\Exports\PostsExport;
use App\Http\Middleware\Peran;
use Maatwebsite\Excel\Facades\Excel;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
       //menampilkan seluruh data
       $posts = Posts::orderBy('id', 'DESC')->get();
       return view('Posts.index',compact('posts'));
    }

    public function apiPosts()
    {
        //menampilkan seluruh data
        $posts = Posts::all();

        return response()->json(
            [
                'success'=>true,
                'message'=>'Data Posts',
                'data'=>$posts,
            ],200);
    }

    public function apiPostsDetail($id)
    {
        $posts = Posts::find($id);
        
        if($posts){ //jika data ditemukan
            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Detail Post',
                    'data'=>$posts,
                ],200);
        }
        else{ //jika data Menu tidak ditemukan
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Detail Posts Tidak ditemukan',
                ],404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ambil master untuk dilooping di select option
        $ar_kategori = Categories::all();
        $ar_user = Userss::all();
        //arahkan ke form input data
        return view('Posts.form',compact('ar_kategori','ar_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:45',
            'content' => 'required|max:45',
            'user_id' => 'required|max:45',
            'category_id' => 'required|max:45',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ],
        [
            'title.required'=>'Title Posts Wajib di Isi',
            'title.max'=>'Title Posts Maksimal 45 Karakter',
            'content.required'=>'Content Wajib di Isi',
            'content.max'=>'Content Maksimal 45 Karakter',
            'category_id.required'=>'categori ID Wajib di Isi',
            'category_id.max'=>'categoriID Maksimal 45 Karakter',
            'user_id.required'=>'Users ID Wajib di Isi',
            'user_id.max'=>'User ID Maksimal 45 Karakter',
        ]
        );
    
        //Pegawai::create($request->all());
        //------------apakah user  ingin upload foto-----------
        if(!empty($request->foto)){
            $fileName = 'foto-'.$request->title.'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('assets_user/img/posts'),$fileName);
        }
        else{
            $fileName = '';
        }

        //lakukan insert data dari request form
        DB::table('posts')->insert(
            [
                'title'=>$request->title,
                'content'=>$request->content,
                'foto'=>$fileName,
                'category_id'=>$request->category_id,
                'user_id'=>$request->user_id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
    
        return redirect()->route('posts.index')
                        ->with('success','Data Posts Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Posts::find($id);
        return view('Posts.detail',compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Posts::find($id);
        return view('Posts.form_edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //proses input pegawai
        $request->validate([
            'title' => 'required|max:45',
            'content' => 'required|max:45',
            'user_id' => 'required|max:45',
            'category_id' => 'required|max:45',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        
        //------------foto lama apabila user ingin ganti foto-----------
        $foto = DB::table('posts')->select('foto')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFileFotoLama = $f->foto;
        }
        //------------apakah user ingin ganti foto lama-----------
        if(!empty($request->foto)){
            //jika ada foto lama, hapus foto lamanya terlebih dahulu
            if(!empty($row->foto)) unlink('assets_user/img/posts'.$row->foto);
            //proses foto lama ganti foto baru
            $fileName = 'foto-'.$request->namaMenu.'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('assets_user/img/posts'),$fileName);
        }
        //------------tidak berniat ganti ganti foto lama-----------
        else{
            $fileName = $namaFileFotoLama;
        }

        //lakukan update data dari request form edit
        DB::table('posts')->where('id',$id)->update(
            [
                'title'=>$request->title,
                'content'=>$request->content,
                'foto'=>$fileName,
                'category_id'=>$request->category_id,
                'user_id'=>$request->user_id,
                'updated_at'=>now(),
            ]);
    
        return redirect()->route('posts.index')
                        ->with('success','Data Posts Berhasil Di Update');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //sebelum hapus data, hapus terlebih dahulu fisik file fotonya jika ada
        $row = Posts::find($id);
        if(!empty($row->foto)) unlink('assets_user/img/posts/'.$row->foto);
        //setelah itu baru hapus data pesanan
        Posts::where('id',$id)->delete();
        return redirect()->route('posts.index')
                        ->with('success','Data Posts Berhasil Dihapus');
    }

    public function postsPDF()
    {
        $posts = Posts::all(); 
        //dd($pegawai);
        $pdf = PDF::loadView('Posts.postsPDF',['posts'=>$posts]);
        return $pdf->download('data_posts.pdf');
    }

    public function postsExcel() 
    {
        return Excel::download(new PostsExport, 'data_posts.xlsx');
    }
}

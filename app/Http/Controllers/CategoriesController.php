<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categories;
use DB;
use PDF;

//excel
use App\Exports\CategoriesExport;
use Maatwebsite\Excel\Facades\Excel;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
        $categories = Categories::orderBy('id', 'DESC')->get();
        return view('Categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //arahkan ke form input data
        return view('Categories.form');
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
            'name' => 'required|max:100'
        ],
        [
            'name.required'=>'Nama Categories Wajib di Isi',
            'name.max'=>'Nama Categories Maksimal 100 Karakter',
        ]
        );
    
        Categories::create($request->all());
    
        return redirect()->route('categories.index')
                        ->with('success','Data Categories Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Categories::find($id);
        return view('Categories.detail',compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Categories::find($id);
        return view('Categories.form_edit',compact('row'));
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
        $request->validate([
            'name' => 'required|max:100'
        ]);

        //lakukan update data dari request form edit
        DB::table('categories')->where('id',$id)->update(
            [
                'name'=>$request->name,
                'updated_at'=>now(),
            ]);
    
        return redirect()->route('categories.index')
                        ->with('success','Data Categories Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //setelah itu baru hapus data pesanan
        Categories::where('id',$id)->delete();
        return redirect()->route('categories.index')
                        ->with('success','Data Categories Berhasil Di hapus');
    }

    public function categoriesPDF()
    {
        $categories = Categories::all(); 
        //dd($pegawai);
        $pdf = PDF::loadView('Categories.categoriesPDF',['categories'=>$categories]);
        return $pdf->download('data_categories.pdf');
    }

    public function categoriesExcel() 
    {
        return Excel::download(new CategoriesExport, 'data_categories.xlsx');
    }
}

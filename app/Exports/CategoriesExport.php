<?php

namespace App\Exports;

use App\Models\Categories;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class CategoriesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Kategori::all();
        $ar_kategori = DB::table('categories')
        ->select('categories.id','categories.name',)
        ->get();
        return $ar_kategori;
    }

    public function headings(): array
    {
        return ["ID", "Nama Kategori",];
    }
}

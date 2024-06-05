<?php
namespace App\Http\Controllers;
use App\Models\Categories;
use App\Models\Posts;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $totalPosts = DB::table('posts')
        ->selectRaw('id, count(id) as jumlah')
        ->groupBy('id')
        ->get();

        $ar_role = DB::table('users')
        ->selectRaw('role, count(role) as jumlah')
        ->groupBy('role')
        ->get();
        return view('Admin.index', compact('totalPosts', 'ar_role'));
    }
}



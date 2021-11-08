<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class problemsController extends Controller
{
    function index(){
        $problems = DB::table('problems')->where('statusId','2')
        ->leftJoin('statuses', 'problems.statusId', '=', 'statuses.statusesId')
        ->leftJoin('categories', 'problems.IdCategory', '=', 'categories.categoryId')->paginate(8);
        $countUsers = DB::table('users')->count();
        $countProblems = DB::table('problems')->where('statusId', 2)->count();
        return view('main', compact('problems', 'countUsers', 'countProblems'));
    }

    function counters(){
        $countUsers = DB::table('users')->count();
        $countProblems = DB::table('problems')->where('statusId', 2)->count();
        return response()->json([
            'countUsers' => $countUsers,
            'countProblems' => $countProblems
        ]);
    }
}

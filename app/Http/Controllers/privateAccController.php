<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class privateAccController extends Controller
{
    function index() {

        $this->middleware('auth');


            $problems = DB::table('problems')->where('userCreatedId', Auth::user()->id)
            ->leftJoin('statuses', 'problems.statusId', '=', 'statuses.statusesId')
            ->leftJoin('categories', 'problems.IdCategory', '=', 'categories.categoryId')->get();
            //dd($problems);
            return view('privateAcc', compact('problems'));
    }

    function back(Request $request ) {
        $problems = DB::table('problems')->where('userCreatedId', $request->id)
            ->leftJoin('statuses', 'problems.statusId', '=', 'statuses.statusesId')
            ->leftJoin('categories', 'problems.IdCategory', '=', 'categories.categoryId')->get();
            //dd($problems);
            return view('layouts.sort', compact('problems'));
    }

    function insertSearch(Request $request) {


        $problems = DB::table('problems')->where('name','like', '%'.$request->prbName.'%')->where('userCreatedId', Auth::user()->id)
        ->leftJoin('statuses', 'problems.statusId', '=', 'statuses.statusesId')
        ->leftJoin('categories', 'problems.IdCategory', '=', 'categories.categoryId')->get();
        return view('layouts.sortAfterSearch', compact('problems'))->render();


    }

    function deleteProblem(Request $request) {

        DB::table('problems')->where('userCreatedId', '=', Auth::user()->id)->where('id', '=', ''.$request->id)->delete();
        $problems = DB::table('problems')->where('userCreatedId', Auth::user()->id)
        ->leftJoin('statuses', 'problems.statusId', '=', 'statuses.statusesId')
        ->leftJoin('categories', 'problems.IdCategory', '=', 'categories.categoryId')->get();
        $problemName = DB::table('problems')->select('name');
        return view('layouts.sort', compact('problems'))->with('message', 'Заявка удалена');

    }




}

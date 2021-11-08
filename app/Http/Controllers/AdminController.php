<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){

        return view('adminPanel');
    }

    public function GetUsers(){
        $users = DB::table('users')->orderBy('created_at', 'desc')->get();
        return view('adminPanel', compact('users'));
    }

    public function GetProblems(){
        $problems = DB::table('problems')->where('statusId', '=', '1')
        ->leftJoin('statuses', 'problems.statusId', '=', 'statuses.statusesId')->get();
        return view('adminPanel', compact('problems'));
    }

    public function GetCategory(){
        $categories = category::all();
        return view('adminPanel', compact('categories'));
    }

    public function GetInputsSolve(){
        return view('layouts.solveProblem');
    }

    public function GetInputsReject(){
        return view('layouts.rejectProblem');
    }

    public function SolveProblem(Request $request){
        $validate = Validator::make($request->all(), ['afterPhoto' => 'required|image:jpg,png,jpeg,bmp']);
        if ($validate->fails()) {
            return view('layouts.solveProblem')->withErrors($validate);
        }
        $path = $request->file('afterPhoto')->store('images', 'public');
        DB::table('problems')->where('id', '=', $request->id)->update([
           'afterPhoto' => $path,
           'statusId' => 2,
            ]
        );
        return view('layouts.message')->with('message', 'Заявка решена');
    }

    public function RejectProblem(Request $request) {
        $validate = Validator::make($request->all(), ['description' => 'required|max:250']);
        if ($validate->fails()) {
            return view('layouts.rejectProblem')->withErrors($validate);
        }
        DB::table('problems')->where('id', '=', $request->id)->update([
            'rejectDescription' => $request->description,
            'statusId' => 3,
            ]
        );
         return view('layouts.message')->with('message', 'Заявка отклонена');
    }

    public function DeleteCategory(Request $request){
        DB::table('categories')->where('categoryId', $request->categoryId)->delete();
        DB::table('problems')->where('IdCategory', $request->categoryId)->delete();
        return view('layouts.message')->with('message', 'Категория удалена');
    }

    public function GetInputsCategory(){
        return view('layouts.addCategory');
    }

    public function AddCategory(Request $request) {
        $validate = Validator::make($request->all(), ['name' => 'required|max:50']);
        if ($validate->fails()) {
            return view('layouts.addCategory')->withErrors($validate);
        }
        DB::table('categories')->insert([
            'categoryName' => $request->name,
        ]);
        return view('layouts.addCategory')->with('message','Категория добавлена');
    }


}

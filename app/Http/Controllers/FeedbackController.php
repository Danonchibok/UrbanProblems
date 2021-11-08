<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


class FeedbackController extends Controller
{
    function index(){

        $categories = category::all();
        return view('feedBack', compact('categories'));
    }

    function insertFeedback(Request $request)
    {
        $categories = category::all();
        $validationRules = ['name' => 'required|max:50',
        'description' => 'required|max:255',
        'category' => 'required',
        'photo' => 'required|image:jpg,png,jpeg,bmp',];

        $validate = Validator::make($request->all(), $validationRules);
        if ($validate->fails()) {

            return back()->withInput()->withErrors($validate);

        }

        $path = $request->file('photo')->store('images', 'public');

        DB::table('problems')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'IdCategory' => $request->category,
            'photo' => $path,
            'statusId' => $request->statusId,
            'userCreatedId' => Auth::user()->id,
            'created_at' => Carbon::now()

            ]
        );
        return view('feedBack', compact('categories'))->with('message', 'Заявка принята');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::where('created_by',Auth::id())->orderBy('created_at','desc')->get();
        return view('categories.index')->with(compact('categories'));
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'category' => ['required'],
            ],
            [
                'category.required' => 'Category name is required',
            ]
        );
        if (!$validator->fails()) {
        Category::create([
            'name' => $request->category,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Session::flash('status','added');

        return redirect('categories');
    }else {
        $messages = $validator->errors();
        return redirect()->route('category.create')->with('error', $messages);
    }
    }

    public function edit($id)
    {
        $categories=Category::find($id);
        return view('categories.edit')->with(compact('categories','id'));
    }

    public function update(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'category' => ['required'],
            ],
            [
                'category.required' => 'Category name is required',
            ]
        );
        if (!$validator->fails()) {
        Category::where('id',$request->hdn_id)->update([
            'name' => $request->category,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Session::flash('status','updated');
        return redirect('categories');
    }else {
        $messages = $validator->errors();
        return redirect()->route('category.edit',$request->hdn_id)->with('error', $messages);
    }
    }

    public function delete($id)
    {
        $categories=Category::find($id);
        if($categories){
            $categories->delete();
        }
        Session::flash('status','deleted');
        return redirect('categories');
    }
}

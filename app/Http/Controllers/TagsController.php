<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TagsController extends Controller
{
    public function index(){
        // dd(Auth::id());
        $tags = Tag::where('created_by',Auth::id())->orderBy('created_at','desc')->get();
        return view('tags.index')->with(compact('tags'));
    }

    public function create(){
        return view('tags.create');
    }

    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'tag' => ['required'],
            ],
            [
                'tag.required' => 'Tag name is required',
            ]
        );
        if (!$validator->fails()) {
        Tag::create([
            'name' => $request->tag,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Session::flash('status','added');

        return redirect('tags');
    }else {
        $messages = $validator->errors();
        return redirect()->route('tag.create')->with('error', $messages);
    }
    }

    public function edit($id)
    {
        $tags=Tag::find($id);
        return view('tags.edit')->with(compact('tags','id'));
    }

    public function update(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'tag' => ['required'],
            ],
            [
                'tag.required' => 'Tag name is required',
            ]
        );
        if (!$validator->fails()) {
        Tag::where('id',$request->hdn_id)->update([
            'name' => $request->tag,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Session::flash('status','updated');
        return redirect('tags');
    }else {
        $messages = $validator->errors();
        return redirect()->route('tag.edit',$request->hdn_id)->with('error', $messages);
    }
    }

    public function delete($id)
    {
        $tags=Tag::find($id);
        if($tags){
            $tags->delete();
        }
        Session::flash('status','deleted');
        return redirect('tags');
    }
}

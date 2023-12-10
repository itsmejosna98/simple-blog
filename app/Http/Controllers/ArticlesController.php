<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\ArticleTag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ArticlesController extends Controller
{
    public function index(){
        $articles = Article::where('created_by',Auth::id())->orderBy('created_at','desc')->get();
        return view('articles.index')->with(compact('articles'));
    }

    public function create(){
        $categories = Category::where('created_by',Auth::id())->get();
        $tags = Tag::where('created_by',Auth::id())->get();
        return view('articles.create')->with(compact('categories','tags'));
    }

    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'title' => ['required'],
                'description' => ['required'],
                'category_id' => ['required'],
                'tags' => ['required'],
                'image' => ['required'],
            ],
            [
                'title.required' => 'Title is required',
                'description.required' => 'Description is required',
                'category_id.required' => 'Category is required',
                'tags.required' => 'Tag is required',
                'image.required' => 'Image is required',
            ]
        );
        if (!$validator->fails()) {
            $lastInsertedId = Article::insertGetId([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'image' => 0,
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    
            if($request->image)
            {
                $image=$request->file('image');
                $image_name='article_'.$lastInsertedId.'_image'.$image->getClientOriginalExtension();
                $destination_path=public_path('/article_image/');
                $image->move($destination_path,$image_name);
    
                Article::where('id',$lastInsertedId)->update([
                    'image' => "/article_image/".$image_name,
                    'updated_at' => Carbon::now(),
                ]);
            }
    
            $count = count($request->tags);
            $tags = $request->tags;
            for ($i=0; $i < $count ; $i++) { 
                ArticleTag::create([
                    'article_id' => $lastInsertedId,
                    'tag_id' => $tags[$i],
                    'created_by' => Auth::id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        
            }
            Session::flash('status','added');
    
            return redirect('articles');
        }else {
            $messages = $validator->errors();
            return redirect()->route('article.create')->with('error', $messages);
        }
    }

    public function edit($id)
    {
        $categories = Category::where('created_by',Auth::id())->get();
        $tags = Tag::where('created_by',Auth::id())->get();
        $articles = Article::leftJoin('article_tags', 'articles.id', '=', 'article_tags.article_id')
    ->leftJoin('tags', 'article_tags.tag_id', '=', 'tags.id')
    ->where('articles.created_by', Auth::id())
    ->where('articles.id', $id) 
    ->select(
        'articles.id',
        'articles.title',
        'articles.description',
        'articles.image',
        'articles.created_by',
        'articles.created_at',
        'article_tags.tag_id',
        'tags.name as tag_name'
    )
    ->first();
    $stored_tags = ArticleTag::where('article_id', $id)->pluck('tag_id')->toArray();
        return view('articles.edit')->with(compact('articles','id','categories','tags','stored_tags'));
    }

    public function update(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'title' => ['required'],
                'description' => ['required'],
                'category_id' => ['required'],
                'tags' => ['required'],
                'image' => ['required'],
            ],
            [
                'title.required' => 'Title is required',
                'description.required' => 'Description is required',
                'category_id.required' => 'Category is required',
                'tags.required' => 'Tag is required',
                'image.required' => 'Image is required',
            ]
        );
        if (!$validator->fails()) {
             Article::where('id',$request->hdn_id)->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => 0,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if ($request->hasFile('image')) {
            $image=$request->file('image');
            $image_name='article_'.$request->hdn_id.'_image'.$image->getClientOriginalExtension();
            $destination_path=public_path('/article_image/');
            $image->move($destination_path,$image_name);

            Article::where('id',$request->hdn_id)->update([
                'image' => "/article_image/".$image_name,
                'updated_at' => Carbon::now(),
            ]);
        }else{
            Article::where('id',$request->hdn_id)->update([
                'image' => $request->image,
                'updated_at' => Carbon::now(),
            ]);
        }
        ArticleTag::where('article_id',$request->hdn_id)->delete();
        $count = count($request->tags);
        $tags = $request->tags;
        for ($i=0; $i < $count ; $i++) { 
            ArticleTag::create([
                'article_id' => $request->hdn_id,
                'tag_id' => $tags[$i],
                'created_by' => Auth::id(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    
        }
        Session::flash('status','updated');

        return redirect('articles');
    }else {
        $messages = $validator->errors();
        return redirect()->route('article.edit',$request->hdn_id)->with('error', $messages);
    }
    }

    public function delete($id)
    {
        $article=Article::find($id);
        if($article){
            $article->delete();
        }
        Session::flash('status','deleted');
        return redirect('articles');
    }

    public function show($id)
    {
        $categories = Category::where('created_by',Auth::id())->get();
        $tags = Tag::where('created_by',Auth::id())->get();
        $articles = Article::leftJoin('article_tags', 'articles.id', '=', 'article_tags.article_id')
    ->leftJoin('tags', 'article_tags.tag_id', '=', 'tags.id')
    ->where('articles.created_by', Auth::id())
    ->where('articles.id', $id) 
    ->select(
        'articles.id',
        'articles.title',
        'articles.description',
        'articles.image',
        'articles.created_by',
        'articles.created_at',
        'article_tags.tag_id',
        'tags.name as tag_name'
    )
    ->first();
    $stored_tags = ArticleTag::where('article_id', $id)->pluck('tag_id')->toArray();
        return view('articles.show')->with(compact('articles','id','categories','tags','stored_tags'));
    }
}

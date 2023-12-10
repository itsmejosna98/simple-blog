<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleTag;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    public function index(){
        $articles = Article::leftJoin('users', 'articles.created_by', '=', 'users.id')
        ->orderBy('created_at','desc')
        ->select(
            'articles.id',
            'articles.title',
            'articles.description',
            'articles.image',
            'articles.created_by',
            'articles.created_at',
            'users.name as user_name'
        )->get();
        return view('website.home',compact('articles'));
    }

    public function articleDetails($id){
        $article = Article::leftJoin('article_tags', 'articles.id', '=', 'article_tags.article_id')
    ->leftJoin('tags', 'article_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'articles.created_by', '=', 'users.id')
    ->where('articles.id', $id) 
    ->select(
        'articles.id',
        'articles.title',
        'articles.description',
        'articles.image',
        'articles.created_by',
        'articles.created_at',
        'article_tags.tag_id',
        'tags.name as tag_name',
        'users.name as user_name'
    )
    ->first();
    $stored_tags = ArticleTag::where('article_id', $id)->pluck('tag_id')->toArray();
    $tags = Tag::whereIn('id',$stored_tags)->pluck('name')->toArray();
    $concatenatedTags = implode('', $tags);
        return view('website.articles',compact('article','stored_tags','concatenatedTags'));
    }
}

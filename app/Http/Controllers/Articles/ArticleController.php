<?php

namespace App\Http\Controllers\Articles;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\StoreArticleRequest;
use App\Http\Requests\Articles\UpdateArticleRequest;
use App\Transformers\ArticleTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class ArticleController extends Controller {

    public function index(){
    	$articles = Article::all();

    	return Fractal::collection($articles, new ArticleTransformer);    	
    	//return Fractal::includes('author')->collection($articles, new ArticleTransformer);
    }

    public function store(StoreArticleRequest $request){
    	$article = new Article;
    	//$article->author_id = 1;
    	$article->author_id = $request->user()->id;
    	$article->title = $request->title;
    	$article->slug = str_slug($request->slug);
    	$article->body = $request->body;
    	$article->save();

    	//return Fractal::item($article, new ArticleTransformer);
    	return Fractal::includes('author')->item($article, new $ArticleTransformer); 	
    }

    public function show(Article $article){    	
    	//return Fractal::item($article, new ArticleTransformer);
    	return Fractal::includes('author')->item($article, new ArticleTransformer);
    }

    public function update(UpdateArticleRequest $request, Article $article){
    	$article->title = $request->get('title', $article->title);
    	$article->slug = ($request->has('title')) ? str_slug($request->get('title')) : $article->slug;
    	$article->body = $request->get('body', $article->body);
    	$article->save();

    	//return Fractal::item($article, new ArticleTransformer);
    	return Fractal::includes('author')->item($article, new ArticleTransformer);
    }

    public function destroy(Article $article){
    	$article->delete();
    	return response(null, 200);    	
    }

}
 


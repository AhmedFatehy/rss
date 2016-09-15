<?php

namespace App\Http\Controllers;

use App\Category;
use App\Feed;
use Illuminate\Http\Request;


class IndexController extends Controller
{

    public function index(){
        $categories = Category::where('status','=','1')->get(['title','slug']);
        $items = Feed::with('category', 'seed');
        $items = $items->where('status','=','1');
        $items = $items->where('slug','<>','');
        $items = $items->where('title','<>','');
//        $items = $items->where('description','<>','');
//        $items = $items->where('image','<>','');
//        $items = $items->select(['title','slug','description','image']);
        $items = $items->orderBy('id','desc');
        $items = $items->orderBy('updated_at','desc');
//        $items = $items->orderBy('image','desc');
        $items = $items->paginate(24);
//        $items = $items->get();
        return view('welcome',compact('categories','items'));
    }

    public function post($post){
        return view('post',['post'=>$post]);
    }
    public function category($category){
        return $category;
        return view('category',['category'=>$category]);
    }
    public function seed($seed){
        return $seed;
        return view('seed',['seed'=>$seed]);
    }
}

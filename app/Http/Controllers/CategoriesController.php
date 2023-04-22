<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    //
    public function index(){
        $categories = Category::where('user_id', auth()->user()->id)->get();
        return Inertia::render('Categories', compact('categories'));
    }

    public function store(StoreCategoryRequest $request){
        // dd($request->all());
        try {
            Category::create([...$request->all(),
                                "user_id"=>auth()->user()->id]);
            return to_route('categories');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function transactions_by_id($id){
        $category = Category::where('id', $id)->with('transactions')->first();
        if(!$category) return to_route('home');
        return Inertia::render('Category', compact('category'));
    }
}

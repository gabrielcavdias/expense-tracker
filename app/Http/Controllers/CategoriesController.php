<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    //
    public function index(Request $request){
        $categories = Category::where('user_id', auth()->user()->id)->get();
        $month = $request->session()->get('month') ?? date("m");
        return Inertia::render('Categories', compact('categories', 'month'));
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

    public function transactions_by_id(Request $request, $id){
        $month = $request->session()->get('month') ?? date("m");
        $category = Category::where('id', $id)
        ->with('transactions', function ($query) use($month){
            $query->whereMonth('date', $month);
        })
        ->first();
        
        if(!$category) return to_route('home');
        return Inertia::render('Category', compact('category', 'month'));
    }
}

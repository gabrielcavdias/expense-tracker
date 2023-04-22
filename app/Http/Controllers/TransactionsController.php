<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Models\Category;
use Inertia\Inertia;

class TransactionsController extends Controller
{
    // Web endpoints

    public function index(){
        $transactions = Transaction::with('category')
        ->where('user_id', auth()->user()->id)
        ->whereMonth('date', date('m'))
        ->whereYear('date', date('Y'))
        ->get();
        $categories = Category::where('user_id', auth()->user()->id)->get();
        return Inertia::render('Transactions',compact('transactions', 'categories'));
    }
    
    public function show($id){
        $transaction = Transaction::where('id', $id)->with('category')->first();
        if(!$transaction){
            return to_route('home');
        }
        return Inertia::render('TransactionSingle', compact('transaction'));
    }

    // API endpoints
    public function single($id){
        $transaction = Transaction::where('id', $id)->with('category')->first();
        if(!$transaction) return response("transaction not found", 404);
        return response()->json($transaction);
    }

    public function store(StoreTransactionRequest $request){
        try {
            Transaction::create([...$request->all(),
                                "user_id"=>auth()->user()->id]);
            return to_route('home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(UpdateTransactionRequest $request, $id){
        $transaction = Transaction::find($id);
        if(!$transaction) return response("transaction not found", 404);
        $transaction->update($request->all());
        return response(200);
    }

    public function destroy($id){
        $transaction = Transaction::find($id);
        if($transaction->user_id==auth()->user()->id){
            Transaction::destroy($id);
            return to_route('home')->with('Transação excluída com sucesso');
        }else{
            return to_route('home');
        }
    }

    public function transactions(){
        return response()->json(Transaction::with('category')->get());
    }
}

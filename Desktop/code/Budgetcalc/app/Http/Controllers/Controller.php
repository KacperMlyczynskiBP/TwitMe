<?php

namespace App\Http\Controllers;

use App\Models\Transcation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function create(){
        return view('home');
    }

    public function results(){
        $transactions=Transcation::all();
        $budget=0;
        foreach($transactions as $transaction){
            if($transaction['status'] === 'Wypływ'){
                $budget=$budget-=$transaction['income'];
            } else{
                $budget=$budget+=$transaction['income'];
            }
        }
        return view('results', compact('transactions', 'budget'));
    }

    public function store(Request $request){
       $input=$request->only('status','job', 'income');
       $transcation=new Transcation(['status'=>$input['status'], 'job'=>$input['job'], 'income'=>$input['income']]);
       $transcation->save();
    }

    public function edit($id){
       $transcation=Transcation::findOrFail($id);
       return $transcation;
    }

    public function delete($id){
        $transcation=Transcation::findOrFail($id);
        $transcation->delete();
    }
}

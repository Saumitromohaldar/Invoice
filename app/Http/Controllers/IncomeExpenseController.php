<?php

namespace App\Http\Controllers;

use App\IncomeExpense;
use Illuminate\Http\Request;
use App\Category;
use Validator;
use Response;
use Carbon\Carbon;
class IncomeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $q=IncomeExpense::with('category');
        if(!empty($_GET['filter_by']) && $_GET['filter_by']=='yearly'){
            $q->whereYear('date', Carbon::now()->year);           
        }elseif(!empty($_GET['filter_by']) && $_GET['filter_by']=='weekly'){
            $q->whereBetween('date', [Carbon::now()->startOfWeek(Carbon::SATURDAY),Carbon::now()->endOfWeek(Carbon::FRIDAY)]);
            
        }elseif(!empty($_GET['filter_by']) && $_GET['filter_by']=='daily'){
            $q->whereDate('date', Carbon::now());
        }elseif(!empty($_GET['start_date'])){

            echo $start_date=date('Y-m-d',strtotime($_GET['start_date']));

            echo $end_date=!empty($_GET['end_date'])?date('Y-m-d',strtotime($_GET['end_date'])):Carbon::now();

            $q->whereBetween('date', [$start_date,$end_date]);
        }else{                     
            $q->whereMonth('date', Carbon::now()->month);
        }        
        $data['income_expenses']=$q->orderBy('date')->get();   

        return view('backend.income-expenses.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['income_categories']=Category::where('type','Income')->pluck('name', 'id');
        $data['expense_categories']=Category::where('type','Expense')->pluck('name', 'id');
        return view('backend.income-expenses.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required'
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }

        $income_expense                 = new IncomeExpense;
        $income_expense->category_id    = $request->category;
        $income_expense->amount         = $request->amount;
        $income_expense->type           = $request->type;
        $income_expense->note           = $request->note;
        $income_expense->date           = date_format(date_create($request->date),'Y-m-d');
        $income_expense->save();

        if($income_expense){
            $response = array(
                'status' => 'success',                
                'message' => $request->type.' added successfully.',
            );
            return Response::json($response);
        }else{
            $response = array(
                'status' => 'fail',
                'message' => 'Something wrong please try again!',
            );
            return Response::json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IncomeExpense  $incomeExpense
     * @return \Illuminate\Http\Response
     */
    public function show(IncomeExpense $incomeExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IncomeExpense  $incomeExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(IncomeExpense $incomeExpense)
    {
        $data['incomeExpense']=$incomeExpense;
        if($incomeExpense->type=="Income"){
            $data['categories']=Category::where('type','Income')->pluck('name', 'id');
        }else{
            $data['categories']=Category::where('type','Expense')->pluck('name', 'id');
        }
        

        return view('backend.income-expenses.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IncomeExpense  $incomeExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IncomeExpense $incomeExpense)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'amount' => 'required',
            'date' => 'required'
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }

        
        $incomeExpense->category_id    = $request->category;
        $incomeExpense->amount         = $request->amount;
        
        $incomeExpense->note           = $request->note;
        $incomeExpense->date           = date_format(date_create($request->date),'Y-m-d');
        $incomeExpense->save();

        if($incomeExpense){
            $response = array(
                'status' => 'success',
                'message' => $incomeExpense->type.' updated successfully.',
            );
            return Response::json($response);
        }else{
            $response = array(
                'status' => 'fail',
                'message' => 'Something wrong please try again!',
            );
            return Response::json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IncomeExpense  $incomeExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomeExpense $incomeExpense)
    {
        $incomeExpense->delete();
        $response = array(
            'status' => 'success',
            'message' => 'Income/Expense deleted successfully.',
        );
        return Response::json($response);
    }
}

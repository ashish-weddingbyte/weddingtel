<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\BudgetExpense;
use App\Models\BudgetCategoryExpense;
use user_helper;


class BudgetController extends Controller
{

    public function __construct(){
        $this->middleware('is_session');
    }


    public function budget(){
        $user_id = Session::get('user_id');
        $data['budget'] = Budget::where('user_id', $user_id)->first();

        // $data['budget_categories'] = BudgetCategory::where('type','default')->orWhere('user_id',$user_id)->orderBy('id','desc')->get();

        $data['budget_categories'] = BudgetCategory::leftJoin('budget_category_expenses','budget_categories.id', '=', 'budget_category_expenses.budget_category_id')
                                    ->select(['budget_categories.*','budget_category_expenses.estimated_cost','budget_category_expenses.final_cost','budget_category_expenses.pending'])
                                    ->orderBy('budget_categories.id','desc')
                                    ->get();

        $data['buget_expense'] = BudgetExpense::where('user_id', $user_id)->get();

        return view('front.user.budget',$data);
    }



    public function add_budget_category(Request $request){
        $request->validate([
            'category_name' => 'required',
        ]);

        $user_id = Session::get('user_id');

        $budget_category = new BudgetCategory;
        $budget_category->user_id = $user_id;
        $budget_category->name = $request->category_name;
        $budget_category->type = 'added';
        $budget_category->icon = '<i class="fa fa-life-ring"></i>';
        $budget_category->status = '1';
        $budget_category->save();

        $lastCategoryId = $budget_category->id;
        $category_expense = new BudgetCategoryExpense;
        $category_expense->user_id = $user_id;
        $category_expense->budget_category_id = $lastCategoryId;
        $category_expense->estimated_cost = $request->estimated_cost;
        $category_expense->pending = 0;
        $category_expense->final_cost = 0;
        $category_expense->status = '1';
        $category_expense->save();

        Session::flash('message', 'Budget Category Added Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Budget Category Added Successfully!']);
    }


    public function edit_budget_category(Request $request){
        $request->validate([
            'estimated_cost' => 'required',
            'category_id' => 'required',
            
        ]);

        $type = $request->type;
        $estimated_cost = $request->estimated_cost;
        $category_id = $request->category_id;
        $category_name = $request->category_name;

        $user_id = Session::get('user_id');


        $budget_category = BudgetCategory::find($category_id);

        
        if($budget_category->type == 'added'){
            $budget_category->name = $category_name;
            $budget_category->save();
        }
        
        $category_expense = BudgetCategoryExpense::where('budget_category_id',$category_id)->first();

        if($category_expense){
            $category_expense->estimated_cost = $estimated_cost;
            $category_expense->save();
        }else{
            $category_expense =new BudgetCategoryExpense;
            $category_expense->user_id = $user_id;
            $category_expense->budget_category_id = $category_id;
            $category_expense->estimated_cost = $estimated_cost;
            $category_expense->final_cost = 0;
            $category_expense->pending = 0;
            $category_expense->status = '1';
            $category_expense->save();
        }

        Session::flash('message', 'Budget Category Edit Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Budget Category Edit Successfully!']);
    }

    public function delete_budget_category(Request $request){
        $request->validate([
            'category_id' => 'required',
        ]);    

        
        $category_id = $request->category_id;
        
        $user_id = Session::get('user_id');


        $budget_category = BudgetCategory::find($category_id);

        
        if($budget_category->type == 'added'){

            $budget_category->delete();
            BudgetCategoryExpense::where('budget_category_id',$category_id)->delete();
            BudgetExpense::where('budget_category_id',$category_id)->where('user_id',$user_id)->delete();
        }else{
            BudgetCategoryExpense::where('budget_category_id',$category_id)->delete();
            BudgetExpense::where('budget_category_id',$category_id)->where('user_id',$user_id)->delete();
        }
        

        user_helper::total_expense_of_user($user_id);
        

        Session::flash('message', 'Budget Category Delete Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Budget Category Delete Successfully!']);
    }



    public function edit_estimated_cost(Request $request){
        $request->validate([
            'estimated_cost' => 'required'
        ]);

        $budget_id = $request->budget_id;
        $estimated_cost = $request->estimated_cost;

        $user_id = Session::get('user_id');

        $budget = Budget::find($budget_id);
        $budget->estimated_cost = $estimated_cost;
        $budget->status = '1';
        $budget->save();

        user_helper::total_expense_of_user($user_id);

        Session::flash('message', 'Budget Estimanted Cost Edit Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Budget Estimanted Cost Edit Successfully!']);
    }



    public function add_budget_expense(Request $request){

        $request->validate([
            'expense_name' => 'required',
            'estimated_cost' => 'required',
            'amount_paid' => 'required',
        ]);

        $pending_amount = $request->estimated_cost - $request->amount_paid;
        $user_id = Session::get('user_id');
        
        // indiviual expense 
        $budget_expense = new BudgetExpense;
        $budget_expense->user_id = $user_id;
        $budget_expense->budget_category_id = $request->category_id;
        $budget_expense->expense_name = $request->expense_name;
        $budget_expense->estimated_cost = $request->estimated_cost;
        $budget_expense->paid = $request->amount_paid;
        $budget_expense->pending = $pending_amount;
        $budget_expense->status = '1';
        $budget_expense->save();


        user_helper::total_expense_of_category($user_id,$request->category_id);
        user_helper::total_expense_of_user($user_id);

        Session::flash('message', 'Budget Expense Added Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Budget Expense Added Successfully!']);
    }



    public function edit_budget_expense(Request $request){
        $request->validate([
            'expense_name' => 'required',
            'estimated_cost' => 'required',
            'amount_paid' => 'required',
        ]);

        $user_id = Session::get('user_id');
        $category_id = $request->category_id;
        $expense_id = $request->expense_id;
        $expense_name = $request->expense_name;
        $estimated_cost = $request->estimated_cost;
        $amount_paid = $request->amount_paid;
        $pending_amount = $estimated_cost - $amount_paid;
        
        // indiviual expense 
        $budget_expense = BudgetExpense::find($expense_id);        
        $budget_expense->expense_name = $expense_name;
        $budget_expense->estimated_cost = $estimated_cost;
        $budget_expense->paid = $amount_paid; 
        $budget_expense->pending = $pending_amount;
        $budget_expense->save();

        user_helper::total_expense_of_category($user_id,$request->category_id);
        user_helper::total_expense_of_user($user_id);

        Session::flash('message', 'Budget Expense Edit Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Budget Expense Edit Successfully!']);
    }


    public function delete_budget_expense(Request $request){
        $request->validate([
            'expense_id' => 'required',
            'category_id' => 'required',
        ]);

        $user_id = Session::get('user_id');

        $category_id = $request->category_id;
        $expense_id = $request->expense_id;
        
        
        // indiviual expense 
        $budget_expense = BudgetExpense::find($expense_id)->delete();        
        
        if($budget_expense){

            user_helper::total_expense_of_category($user_id,$request->category_id);
            user_helper::total_expense_of_user($user_id);

            Session::flash('message', 'Budget Expense Delete Successfully!');
            Session::flash('class', 'alert-success');

        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
        }
        
        return response()->json(['success' => 'Budget Expense Delete Successfully!']);
    }
}

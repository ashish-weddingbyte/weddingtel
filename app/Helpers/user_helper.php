<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use App\Models\Checklist;
use App\Models\UserDetail;
use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\BudgetExpense;
use App\Models\BudgetCategoryExpense;
use App\Models\Wishlist;

use Carbon\Carbon;

class user_helper {

    public static function add_default_checklist($user_id){
        $user = UserDetail::select('event')->where('user_id',$user_id)->first();
        

        // before 5 month default checklist
        $event_date_before_5_months = Carbon::create($user->event);
        $before_5_months = $event_date_before_5_months->subMonth(5)->format('Y-m-d');
        $before_5_months_array = [
            ['user_id'=>$user_id, 'task'=>'Decide wedding budget','added_date'=>$before_5_months],
            ['user_id'=>$user_id, 'task'=>'Estimate guest count','added_date'=>$before_5_months],
            ['user_id'=>$user_id, 'task'=>'Book Photographer','added_date'=>$before_5_months],
            ['user_id'=>$user_id, 'task'=>'Book Makeup Artist','added_date'=>$before_5_months],
            ['user_id'=>$user_id, 'task'=>'Research Honeymoon destinations','added_date'=>$before_5_months],
        ];


        // before 4 month default checklist
        $event_date_before_4_months = Carbon::create($user->event); 
        $before_4_months  = $event_date_before_4_months->subMonth(4)->format('Y-m-d');
        $before_4_months_array = [
            ['user_id'=>$user_id, 'task'=>'Buy Jewellery','added_date'=>$before_4_months],
            ['user_id'=>$user_id, 'task'=>'Research outfit stores','added_date'=>$before_4_months],
            ['user_id'=>$user_id, 'task'=>'Make Guest List','added_date'=>$before_4_months],
            ['user_id'=>$user_id, 'task'=>'Research Bridal Wear stores','added_date'=>$before_4_months],
            ['user_id'=>$user_id, 'task'=>'Start Visa arrangements','added_date'=>$before_4_months],
        ];


        // before 3 month default checklist
        $event_date_before_3_months = Carbon::create($user->event); 
        $before_3_months  = $event_date_before_3_months->subMonth(3)->format('Y-m-d');
        $before_3_months_array = [
            ['user_id'=>$user_id, 'task'=>'Shortlist Bridal entry songs','added_date'=>$before_3_months],
            ['user_id'=>$user_id, 'task'=>'Book DJ','added_date'=>$before_3_months],
            ['user_id'=>$user_id, 'task'=>'Find Choreographer','added_date'=>$before_3_months],
            ['user_id'=>$user_id, 'task'=>'Book Mehendi Artist','added_date'=>$before_3_months],
            ['user_id'=>$user_id, 'task'=>'Browse Hairstyle Ideas','added_date'=>$before_3_months],
            ['user_id'=>$user_id, 'task'=>'Order for Invitation Cards','added_date'=>$before_3_months]
        ];


        // before 2 month default checklist
        $event_date_before_2_months = Carbon::create($user->event); 
        $before_2_months  = $event_date_before_2_months->subMonth(2)->format('Y-m-d');
        $before_2_months_array = [
            ['user_id'=>$user_id, 'task'=>'Start distributing invitations','added_date'=>$before_2_months],
            ['user_id'=>$user_id, 'task'=>'Do a site visit with Decorator','added_date'=>$before_2_months],
            ['user_id'=>$user_id, 'task'=>'Research Sangeet Songs','added_date'=>$before_2_months],
            ['user_id'=>$user_id, 'task'=>'Start dance practices','added_date'=>$before_2_months],
            ['user_id'=>$user_id, 'task'=>'Book Family makeup services','added_date'=>$before_2_months],
            
        ];

        // before 1 month default checklist
        $event_date_before_1_months = Carbon::create($user->event); 
        $before_1_months  = $event_date_before_1_months->subMonth(1)->format('Y-m-d');
        $before_1_months_array = [
            ['user_id'=>$user_id, 'task'=>'Start pre-bridal Skincare Packages','added_date'=>$before_1_months],
            ['user_id'=>$user_id, 'task'=>'Buy Groom and Bridal Accessories','added_date'=>$before_1_months],
            ['user_id'=>$user_id, 'task'=>'Organise Logistics and Transport for out-of-town Guests','added_date'=>$before_1_months],
            ['user_id'=>$user_id, 'task'=>'Book your priest','added_date'=>$before_1_months],
            ['user_id'=>$user_id, 'task'=>'Reconfirm time with vendors','added_date'=>$before_1_months],
        ];

        // before 0 month default checklist
        $event_date_before_0_months = Carbon::create($user->event)->format('Y-m-d'); 
        $before_0_months_array = [
            ['user_id'=>$user_id, 'task'=>'Get married to the love of your life!','added_date'=>$event_date_before_0_months],
        ];

        // after 15 days default checklist
        $event_date_after_15_days = Carbon::create($user->event);
        $after_15_days = $event_date_after_15_days->addDay(15)->format('Y-m-d');
        $after_15_days_array = [
            ['user_id'=>$user_id, 'task'=>'Submit your wedding to be featured on WeddingByte','added_date'=>$after_15_days],
        ];

        $default_checklists = array_merge($before_5_months_array,$before_4_months_array,$before_3_months_array,$before_2_months_array,$before_1_months_array,$before_0_months_array,$after_15_days_array);


        foreach($default_checklists as $value){
            Checklist::create($value);
        }

        
    }

    public static function group_checklist_by_month(Array $checklist_array){

        $years = Array();
        $months = Array();
        foreach($checklist_array as $d) {
            list($y,$m) = explode("-",$d['added_date']);
            $years[$y][] = $d;
            $months[$y."-".$m][] = $d;
        }
        $years = array_values($years);
        $months = array_values($months);


        return $months;
    }

    public static function total_expense_of_user($user_id){
        if(isset($user_id)){
            $total_paid = BudgetExpense::where('user_id',$user_id)->sum('paid');
            $total_pending = BudgetExpense::where('user_id',$user_id)->sum('pending');

            $budget_data = Budget::where('user_id',$user_id)->first();
            $budget_data->final_cost = $total_paid;
            $budget_data->pending = $total_pending;
            $budget_data->save();

            return true;
        }else{
            return false;
        }
    }

    public static function total_expense_of_category($user_id, $category_id){

        if(isset($user_id) && isset($category_id) ){

            $total_estimated_cost_of_category =  BudgetExpense::where('user_id',$user_id)->where('budget_category_id',$category_id)->sum('estimated_cost');

            $total_paid_of_category =  BudgetExpense::where('user_id',$user_id)->where('budget_category_id',$category_id)->sum('paid');

            $total_pending_of_category =  BudgetExpense::where('user_id',$user_id)->where('budget_category_id',$category_id)->sum('pending');

            $category_expense = BudgetCategoryExpense::where('user_id',$user_id)->where('budget_category_id',$category_id)->first();

            if(!empty($category_expense)){
                $category_expense->estimated_cost = $total_estimated_cost_of_category;
                $category_expense->final_cost = $total_paid_of_category;
                $category_expense->pending = $total_pending_of_category;
                $category_expense->save();
            }else{
                $category_expense = new BudgetCategoryExpense;
                $category_expense->user_id = $user_id;
                $category_expense->budget_category_id = $category_id;
                $category_expense->estimated_cost = 0 ;
                $category_expense->final_cost = $total_paid_of_category;
                $category_expense->pending = $total_pending_of_category;
                $category_expense->status = '1';
                $category_expense->save();
            }
            return true;
        }else{
            return false;
        }
    }

    public static function check_wishlist($vendor_id){
        $user_id = Session::get('user_id');
        
        $data = Wishlist::where('from_id',$user_id)->where('to_id',$vendor_id)->first();

        if(!empty($data)){
            return true;
        }else{
            return false;
        }
    }

    public static function active_menu($url = ''){
        $active = '';
        if( request()->segment(2) == $url ){
            $active = 'active';
        }
        return $active;
    }

}



?>
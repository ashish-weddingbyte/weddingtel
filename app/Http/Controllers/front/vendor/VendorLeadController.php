<?php

namespace App\Http\Controllers\front\vendor;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Leads;
use App\Models\User;
use App\Models\VendorDetail;
use App\Models\LeadPaidVendor;
use App\Models\PositionPaidVendor;
use App\Models\LeadViewStatus;
use App\Models\Query;
use App\Models\PremiumLead;
use App\Models\PremiumLeadVendor;
use App\Models\QueryViewStatus;
use vendor_helper;
use Carbon\Carbon;


class VendorLeadController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function leads(){
        
        $user_id = Session::get('user_id');

        $vendor_details = VendorDetail::where('user_id',$user_id)->first();

        $data['leads'] = Leads::where('approved_status','1')
                                ->where('category_id',$vendor_details->category_id)
                                ->where('event_date','>', date('Y-m-d') )
                                ->orderBy('created_at','desc')
                                ->orderBy('id','desc')
                                ->paginate(20);
        return view('front.vendor.leads',$data);
    }

    public function view_lead(Request $request){
        $lead_id = $request->id;
        $user_id = Session::get('user_id');

        $paid_status = vendor_helper::is_lead_paid_vendor($user_id);

        $view_lead_check = LeadViewStatus::where('user_id',$user_id)->where('lead_id',$lead_id)->first();

        $daily_count = LeadViewStatus::where('user_id',$user_id)->whereDate('created_at', date('Y-m-d'))->count();

        $paid = LeadPaidVendor::where('user_id',$user_id)
                                ->where('is_active','1')
                                ->orderBy('id','desc')
                                ->first();
        if($daily_count < 2){

            if($paid_status == '1'){
                
                if($paid->available_leads > 0){

                    $leads = Leads::where('id',$lead_id)->where('status','1')->first();
                    
                    if($leads->view_count < 8){

                        if(empty($view_lead_check)){

                            $leads->view_count = $leads->view_count + 1;
                            $leads->save();

                            $paid->available_leads = $paid->available_leads - 1;
                            $paid->save();

                            $lead_view_status = new LeadViewStatus;
                            $lead_view_status->lead_id = $lead_id;
                            $lead_view_status->user_id = $user_id;
                            $lead_view_status->created_at = date('Y-m-d');
                            $lead_view_status->time = date('Y-m-d H:m:s');
                            $lead_view_status->save();
                        }

                        $data = [
                            'status'    =>  '1',
                            'type'      =>  'lead',
                            'message'   =>  '<div class="alert alert-success">Lead is Open,You Can View in the unlock Lead Tab.</div>'
                        ];
                        return response()->json($data);

                    }else{
                        $leads->status = '0';
                        $leads->save();
                        $data = [
                            'status'    =>  '0',
                            'type'      =>  'lead',
                            'message'   =>  '<div class="alert alert-danger">Lead is Deactive, You Can not open this Lead.</div>'
                        ];
                        return response()->json($data);
                    }




                }else{
                    $data = [
                        'status'    =>  '0',
                        'type'      =>  'lead',
                        'message'   =>  '<div class="alert alert-danger">All Leads are used, Please Purchase other plan to open lead.</div>'
                    ];
                    return response()->json($data);
                }

            }else{
                $data = [
                    'status'    =>  '0',
                    'type'      =>  'lead',
                    'message'   =>  '<div class="alert alert-danger">Please Purchase Lead Plan For View this Lead.</div>'
                ];
                return response()->json($data);
            }
        }else{
           
            $data = [
                'status'    =>  '0',
                'type'      =>  'lead',
                'message'   =>  '<div class="alert alert-danger">Your Daily Lead Limit is Exhausted.</div>'
            ];
            return response()->json($data);
        }


    }


    public function view_query(Request $request){

        $query_id = $request->id;
        $user_id = Session::get('user_id');

        $paid_status = vendor_helper::is_position_paid_vendor($user_id);

        $view_status = QueryViewStatus::where('user_id',$user_id)->where('query_id',$query_id)->first();
    
        $count = QueryViewStatus::where('user_id',$user_id)->count();

        
        if($paid_status == true){

            if(empty($view_status)){
                $view = new QueryViewStatus();
                $view->query_id = $query_id;
                $view->user_id = $user_id;
                $view->save();

                $qry = Query::find($query_id);
                $qry->view_status = '1';
                $qry->save();

            }
            
            Session::flash('message', 'Query is Open Now!');
            Session::flash('class', 'alert-success');
            return redirect("/vendor/query/view/details/$query_id");

        }else{

            if($count <= 5){
                if(empty($view_status)){
                    $view = new QueryViewStatus();
                    $view->query_id = $query_id;
                    $view->user_id = $user_id;
                    $view->save();

                    $qry = Query::find($query_id);
                    $qry->view_status = '1';
                    $qry->save();
                }
                Session::flash('message', 'Query is Open Now!');
                Session::flash('class', 'alert-success');
                return redirect("/vendor/query/view/details/$query_id");
            }else{
                
                Session::flash('message', 'All Free 5 Queries are used. Please Purchase Position Plan To View More Queries.');
                Session::flash('class', 'alert-danger');
                return back();
            }
        }

    }

    public function view_query_details(Request $request){
        $query_id = $request->id;
        $user_id = Session::get('user_id');

        $check_view_query = QueryViewStatus::where('user_id',$user_id)->where('query_id',$query_id)->first();

        if(!empty($check_view_query)){

            $data['query'] = Query::where('id',$query_id)->first();
            $data['view_status'] = QueryViewStatus::where('user_id',$user_id)->where('query_id',$query_id)->first();
            return view('front.vendor.query_details',$data);
        }else{
            return redirect('vendor/query');
        }

    }


    public function view_lead_details(Request $request){
        $lead_id = $request->id;
        $user_id = Session::get('user_id');

        $check_view_lead = LeadViewStatus::where('user_id',$user_id)->where('lead_id',$lead_id)->first();

        if(!empty($check_view_lead)){

            $data['leads'] = Leads::where('id',$lead_id)->first();
            $data['view_status'] = LeadViewStatus::where('user_id',$user_id)->where('lead_id',$lead_id)->first();
            return view('front.vendor.lead_details',$data);
        }else{
            return redirect('vendor/leads');
        }

    }

    public function unlock_leads(){
        $user_id = Session::get('user_id');
        $vendor_details = VendorDetail::where('user_id',$user_id)->first();

        $data['leads'] = Leads::join('lead_view_status','lead_view_status.lead_id','leads.id')
                                ->where('lead_view_status.user_id',$user_id)
                                ->select(['leads.*','lead_view_status.created_at'])
                                ->orderBy('lead_view_status.id','desc')
                                ->get();
            
        return view('front.vendor.unlock_leads',$data);

    }

    public function all_query(){
        $user_id = Session::get('user_id');
        $vendor_details = User::where('id',$user_id)->first();

        $data['query'] = Query::where('vendor_id',$user_id)->orderBy('id','desc')->get();
            
        return view('front.vendor.query',$data);
    }


    public function exclusive_leads(){
        
        $user_id = Session::get('user_id');


        $data['leads'] = PremiumLeadVendor::join('premium_leads','premium_leads.id','=','premium_lead_vendors.lead_id')
                                        ->orderBy('premium_lead_vendors.created_at','desc')
                                        ->where('premium_lead_vendors.user_id',$user_id)
                                        ->get();
                                        // dd($data);
        return view('front.vendor.premium_leads',$data);
    }

    public function view_exclusive_leads(Request $request){
        $user_id = Session::get('user_id');
        $lead_id = $request->id;

        $lead_view_status = PremiumLeadVendor::where('lead_id',$lead_id)->where('user_id',$user_id)->first();

        if($lead_view_status){
            $data['leads'] = PremiumLead::find($lead_id);
            return view('front.vendor.premium_lead_details',$data);
        }else{
            return back();
        }
    }

}



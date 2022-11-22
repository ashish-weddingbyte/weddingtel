<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

use App\Models\LeadPaidVendor;
use App\Models\PaymentHistory;
use App\Models\LeadPlan;
use Carbon\Carbon;

class RazorPayController extends Controller
{
    public function index()
    {
        return view('front.razorpay');
    }

    public function create_order(Request $request){
        $receiptId = sha1(time());
        $amount = $request->amount;
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $order =  $api->order->create([
            'receipt' => $receiptId,
            'amount' => $amount * 100,
            'currency' => 'INR'
        ]);
        
        $plan = LeadPlan::find($request->plan_id);
        $amount = $plan->price;

        $payment = new PaymentHistory();
        $payment->user_id = Session::get('user_id');
        $payment->plan_id = $request->plan_id;
        $payment->plan_type = 'lead';
        $payment->payment_mode = 'Online';
        $payment->payment_id = "";
        $payment->order_id = $order['id'];
        $payment->status = 'pending';
        $payment->remark = "Payment via Razorpay.";
        $payment->price = $amount;
        $payment->save();



        $response = [
            'orderId' => $order['id'],
            'razorpayId' => env('RAZORPAY_KEY'),
            'amount' => $amount * 100,
            'name' => Session::get('name'),
            'currency' => 'INR',
            'email' => Session::get('email'),
            'description' => "Buy Plan",
        ];

        return view('front.razorpay',compact('response'));
    }



    public function store(Request $request){
        // return $request;
        // Now verify the signature is correct . We create the private function for verify the signature
        $signatureStatus = $this->SignatureVerify(
            $request->rzp_signature,
            $request->rzp_paymentid,
            $request->rzp_orderid
        );

        // If Signature status is true We will save the payment response in our database
        // In this tutorial we send the response to Success page if payment successfully made
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        if($signatureStatus == true)
        {
            
            $payment =  PaymentHistory::where('order_id',$request->rzp_orderid)->where('user_id',Session::get('user_id'))->first();
            $payment->payment_id = $request->rzp_paymentid;
            $payment->status = 'success';
            $payment->save();

            $plan_id = $payment->plan_id;


            $old_plan = LeadPaidVendor::where('user_id',Session::get('user_id'))
                                            ->where('is_active','1')
                                            ->where('available_leads','>','0')
                                            ->orderBy('id','desc')
                                            ->first();
            if(!empty($old_plan)){
                $old_plan->is_active = '0';
                $old_plan->save();
            }
            $plan = LeadPlan::find($plan_id);
            $start = Carbon::now()->format('Y-m-d');
            $end = Carbon::now()->addDays($plan->days)->format("Y-m-d");
            

            $new_paid = new LeadPaidVendor();
            $new_paid->user_id = Session::get('user_id');
            $new_paid->plan_id = $plan->id;
            $new_paid->plan_name = $plan->name;
            $new_paid->lead = $plan->leads;
            $new_paid->total_lead = $plan->leads;
            $new_paid->available_leads = $plan->leads;
            $new_paid->start_at = $start;
            $new_paid->end_at = $end;
            $new_paid->is_active = '1';
            $new_paid->is_addon = "no";
            $new_paid->save();

            Session::flash('message', 'Payment Successfully!');
            Session::flash('class', 'alert-success');
            return redirect('vendor/dashboard');

        }
        else{
            $payment =  PaymentHistory::where('order_id',$request->rzp_orderid)->where('user_id',Session::get('user_id'))->first();
            $payment->status = 'fail';
            $payment->save();

            Session::flash('message', 'Payment Failed!');
            Session::flash('class', 'alert-danger');
            return redirect('vendor/dashboard');
        }
    }


    private function SignatureVerify($_signature,$_paymentId,$_orderId)
    {
        try
        {
            // Create an object of razorpay class
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
            $order  = $api->utility->verifyPaymentSignature($attributes);
            return true;
        }
        catch(\Exception $e)
        {
            // If Signature is not correct its give a excetption so we use try catch
            return false;
        }
    }

}

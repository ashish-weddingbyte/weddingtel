<?php
namespace App\Helpers;

class otp_helper {
    public static function send_otp($mobile, $message){
        // textidea.com
        $api_key = env('OTP_API_KEY');
        $contacts = $mobile;
        $from = 'TEXTIT';
        $sms_text = urlencode($message);

        //Submit to server

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, "http://websms.textidea.com/app/smsapi/index.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=8468&routeid=16&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;



        // fast2sms.com
        // $fields = array(
        //     "variables_values" => "$message",
        //     "route" => "otp",
        //     "numbers" => "$mobile",
        // );
    
        // $curl = curl_init();
    
        // curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => "",
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 30,
        // CURLOPT_SSL_VERIFYHOST => 0,
        // CURLOPT_SSL_VERIFYPEER => 0,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // CURLOPT_CUSTOMREQUEST => "POST",
        // CURLOPT_POSTFIELDS => json_encode($fields),
        // CURLOPT_HTTPHEADER => array(
        //     "authorization: 70AmzWrgEBXFHUi1JCSjkIaOd6sqLxMvQ4Y5DfZPnVc3K9yRGuGz7dSo0CRyekLpYbx4nXIwmDUfhsKW",
        //     "accept: */*",
        //     "cache-control: no-cache",
        //     "content-type: application/json"
        // ),
        // ));
    
        // $response = curl_exec($curl);
        // $err = curl_error($curl);
    
        // curl_close($curl);

        // echo $response;

    }
}



?>
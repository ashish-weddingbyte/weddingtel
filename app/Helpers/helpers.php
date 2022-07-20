<?php


function send_otp($mobile, $message){
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
}




?>


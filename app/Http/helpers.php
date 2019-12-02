<?php
date_default_timezone_set('Asia/Kolkata');

# Convert date Format
function convert_date_format($date)
{
    $date = date('jS M, Y', strtotime($date));
    return $date;
}
function sendsms($numbers, $message)
{
    // Textlocal account details
    $username = urlencode('s1542');
    $password = urlencode('723377837');

    // Message details
    $numbers = urlencode($numbers);
    $sender = urlencode('Apnago');
    $message = urlencode($message);

    // Prepare data for POST request
    $data = 'username=' . $username . '&password=' . $password . "&mobileno=" . $numbers . '&sendername=' . $sender . "&message=" . $message;

    // Send the GET request with cURL
    $ch = curl_init("http://bulksms.mysmsmantra.com:80/WebSMS/SMSAPI.jsp?".$data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    /*echo "<pre>";
    print_r($response);
    die;*/

    // Process your response here
    return $response;

}
function sendotp($numbers, $message, $otp)
{
    // Textlocal account details
    // Message details
    $numbers = urlencode($numbers);
    $sender_id = urlencode('Apnago');
    $message = urlencode($message);

    // Prepare data for POST request

    // Send the GET request with cURL
    $ch = curl_init("http://api.msg91.com/api/sendotp.php?authkey=266899A2ost0sayEab5c868a01&mobile=".$numbers."&message=".$message."&sender=".$sender_id."&otp=".$otp);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Process your response here
    return $response;

}
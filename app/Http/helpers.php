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
    $password = urlencode('sky844');

    // Message details
    $numbers = urlencode($numbers);
    $sender = urlencode('RKWARE');
    $message = urlencode($message);

    // Prepare data for POST request
    $data = 'username=' . $username . '&password=' . $password . "&mobileno=" . $numbers . '&sendername=' . $sender . "&message=" . $message;

    // Send the GET request with cURL
    $ch = curl_init("http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?".$data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Process your response here
    return $response;

}
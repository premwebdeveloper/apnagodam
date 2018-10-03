-- ------------------- `ALTER TABLE `user_details` at 17-09-2018 -------------------
ALTER TABLE `user_details` CHANGE `lname` `lname` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `users` CHANGE `lname` `lname` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;

-- ------------------- ALTER TABLE `categories` at 26-09-2018 -------------------
ALTER TABLE `categories` ADD `image` VARCHAR(255) NULL AFTER `freight`;


----------OTP CODE-----------
public function send_sms($mobilesArr, $sms)
    {
        
        $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp";
        
        $mobiles = implode(",", $mobilesArr);

        $params = array(
                    "username" => "s1542",
                    "password" => "sky844",
                    "sendername" => "rkware",
                    "mobileno" => $mobiles,
                    "message" => $sms
                    );

        $params = http_build_query($params);            

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        //echo $result;
        return true;
    }
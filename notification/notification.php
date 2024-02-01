<?php

function notifyToAdmin($title,$body){      
//$url and $token is fixed for all projects	-----
    $url = "https://fcm.googleapis.com/fcm/send";
    $token = "/topics/all";
    $click_aciton = "com.nearchair.admin_TARGET_NOTIFICATION";
//------------------------------------------------- 

 // change the server key with firebase FCM serverkey
   $serverKey = 'AAAA4nn5ScM:APA91bHYzvcNsGx245zCHH1ccfX0UCO-_aZ4gCXkSwTEoFLik68BE3zX9jAnKmzmQjla4RyqVW39yuNUxQD_ZlawO2KvoyGncOFs9BHdoWUNmRlK-FWROZN0iDabJtsK6nWY3ZH_oc3O';
   
    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'click_action' => 'com.nearchair.admin_TARGET_NOTIFICATION','badge' => '1');
    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
}

notifyToAdmin("Hello","test");

?>
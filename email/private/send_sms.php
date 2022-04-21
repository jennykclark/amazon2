<?php

// set post fields
$post = [
    'phone'   => '91746794',
    'to_phone'   => $to_phone,
    'message'   => $sms_content,
    'api_key'   => '0d10ce6e-be1e-4f42-8e9e-7c169bc58a2f',
];


$ch = curl_init('https://fatsms.com/send-sms');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
var_dump($response);
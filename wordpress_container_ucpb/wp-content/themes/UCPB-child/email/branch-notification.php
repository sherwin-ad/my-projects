<?php
require_once "vendor/autoload.php";
 
use GuzzleHttp\Client;

$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://api.mailjet.com/v3.1/',
]);
 

    $body = [
        'Messages' => [
            [
            'From' => [
                'Email' => "no-reply@mybusybee.net",
                'Name' => "UCPBS"
            ],
            'To' => [
                [
                    'Email' => "$emailtoSend",
                    'Name' => "$emailName"
                ]
            ],
             'Subject' => "$emailSubject",
            'HTMLPart' => "$emailContent",
            
            ]
        ]
    ];


    
$response = $client->request('POST', 'send', [
    'json' => $body,
    'auth' => ['d057ae729def1cc326eb25f14fc61fac', '0a678a9fb8f7421d89a65df188e7e32f']
]);
$postID = get_the_id();

 
if($response->getStatusCode() == 200) {
    $body = $response->getBody();
    $response = json_decode($body);
    if ($response->Messages[0]->Status == 'success') {
        update_field('email_notification', 'yes', $postID);
    }else {
        echo 'failed';
    }
}else {
    echo 'failed';
}
<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => true,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAn7fUu40:APA91bGoqEJ42XS4zVaUvsiMj7G1MUAGjZIiNFrOraUDE2DR8aRcTX1qEDyaGnnP_90S4pO-cCwvFViH3-wt0GNJwEs_5xIK-uMZkGjMp04LwkGh9ihgQQl78tbYv3-koLHRKiiK5qXD'),
        'sender_id' => env('FCM_SENDER_ID', '685983972237'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];

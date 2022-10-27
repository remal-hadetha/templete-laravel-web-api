<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAd0U0Mew:APA91bFbPZiJMt52GAuQSy8QqHyqX62lN8UJjLe2HG21Tjt4p0h-H0E_zMbT065x83TaxKbxxjdeb3DjmhN3D0MarXPFgRTCc1bMIpQkfubdadCUv0c_MdPjD-16Pjc4JC4aI1Ed0EWi'),
        'sender_id' => env('FCM_SENDER_ID', '512262156780'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];

<?php

return [

    'username' => env('PAYPING_USERNAME','Your payping username'),

    'password' => env('PAYPING_PASSWORD','Your payping password'),

    'token' => env('PAYPING_TOKEN','payping token (get by calling getToken method.)'),

    'user-key' => env('PAYPING_USER_KEY','payping user key (get by calling getUserKey method.)'),

    'return-url' => env('PAYPING_RETURN_URL','your return url after payment'),

];
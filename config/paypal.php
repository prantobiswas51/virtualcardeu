<?php 

return [
    'client_id' => env('PAYPAL_CLIENT_ID', ''),
    'secret' => env('PAYPAL_SECRET', ''),
    'env' => env('PAYPAL_ENV', ''),
    'redirect_uri' => env('PAYPAL_REDIRECT_URI', ''),
    'merchant_id' => env('PAYPAL_MERCHANT_ID', ''),

    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path('logs/paypal.log'),
        'log.LogLevel' => 'FINE',
    )
];
<?php 

return [
    'env' => env('PAYPAL_ENV', ''),
    'redirect_uri' => env('PAYPAL_REDIRECT_URI', ''),
    
    // Nowpayemtns
    'nowpayment_key' => env('NOWPAYMENTS_API_KEY', ''),
    'nowpayment_email' => env('NOWPAYMENTS_EMAIL',''),
    'nowpayment_password' => env('NOWPAYMENTS_PASSWORD',''),

    'settings' => array(
        'mode' => 'live',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path('logs/paypal.log'),
        'log.LogLevel' => 'FINE',
    )
];
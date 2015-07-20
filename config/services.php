<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'twilio' => [
        'twilio_account_sid' => env('TWILIO_ACCOUNT_SID'),
        'twilio_auth_token' => env('TWILIO_AUTH_TOKEN'),
        'twilio_sending_number' => env('TWILIO_SENDING_NUMBER')
    ]
];

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
        'client_id' => env('GITHUB_ID'),
        'client_secret' => env('GITHUB_SECRET'),
        'redirect' => env('GITHUB_URL'),
    ],

    'intercom' => [
        'app_id' => env('INTERCOM_APP_ID'),
        'secret' => env('INTERCOM_SECRET'),
    ],

    'google' => [
        'ad_sense' => [
            'client' => env('GOOGLE_AD_SENSE_AD_CLIENT'),
            'unit_footer' => env('GOOGLE_AD_SENSE_UNIT_FOOTER'),
            'unit_forum_sidebar' => env('GOOGLE_AD_SENSE_UNIT_FORUM_SIDEBAR'),
        ],
        'client_id' => env('GOOGLE_CLIENT_ID'),         // Your Google Client ID
        'client_secret' => env('GOOGLE_CLIENT_SECRET'), // Your Google Client Secret
        'redirect' => env('GOOGLE_URL'),
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'), //add your app-id here
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'), //add your secret-id here
        'redirect' => env('FACEBOOK_URL'),
    ],

    'bsa' => [
        'cpc_code' => env('BSA_CPC_CODE'),
    ],

];

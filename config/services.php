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

    'mailgun'   => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses'       => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe'    => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github'    => [
        'client_id'     => 'your-github-app-id',
        'client_secret' => 'your-github-app-secret',
        'redirect'      => 'http://localhost:8000/auth/github/callback',
    ],
    'facebook'  => [
        'client_id'     => '284192238629971',
        'client_secret' => '45836f7f525ef5e5f418b79eb8ae1de2',
        'redirect'      => 'http://localhost:8000/auth/facebook/callback',
    ],
    'twitter'   => [
        'client_id'     => '284192238629971',
        'client_secret' => '45836f7f525ef5e5f418b79eb8ae1de2',
        'redirect'      => 'http://localhost:8000/auth/twitter/callback',
    ],
    'linkedin'  => [
        'client_id'     => '',
        'client_secret' => '',
        'redirect'      => 'http://localhost:8000/auth/linkedin/callback',
    ],
    'google'    => [
        'client_id'     => '',
        'client_secret' => '',
        'redirect'      => 'http://localhost:8000/auth/google/callback',
    ],

];

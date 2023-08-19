<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'base_url' => env('ICINGA_BASE_URL', 'https://icinga.cranleigh.org:5665/v1/'),
    'port' => env('ICINGA_PORT', '5665'),
    'username' => env('ICINGA_USERNAME', 'apiuser'),
    'password' => env('ICINGA_PASSWORD', 'apiuser'),
    'cert' => env('ICINGA_CERT', '/etc/ssl/certs/icinga2.crt'),
    'ssl_verify' => env('ICINGA_SSL_VERIFY', true),
];

<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'host' => env('ICINGA_HOST', 'https://icinga.cranleigh.org'),
    'port' => env('ICINGA_PORT', '5665'),
    'username' => env('ICINGA_USERNAME', 'apiuser'),
    'password' => env('ICINGA_PASSWORD', 'apiuser'),
    'cert' => env('ICINGA_CERT', '/etc/ssl/certs/icinga2.crt'),
];

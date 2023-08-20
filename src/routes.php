<?php
\Illuminate\Support\Facades\Route::group(['prefix' => 'icinga'], function() {
    \Illuminate\Support\Facades\Route::get('dashboard', function() {
        return view('icinga-wire-dash::index');
    });
});

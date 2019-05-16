<?php

Route::group([
    'prefix' => 'cabinet',
    'namespace' => 'Cabinet',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'IndexController@index');
});

<?php

Route::group([
    'prefix' => 'cabinet',
    'namespace' => 'Cabinet',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'IndexController@index')->name('cabinet.index');
    Route::get('/task/{task}', 'TaskController@detail')->name('cabinet.task.detail');
    Route::get('/task/{task}/comment/create', 'CommentController@create')->name('cabinet.task.comment.create');
});

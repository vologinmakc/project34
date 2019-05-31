<?php

Route::group([
    'prefix' => 'cabinet',
    'namespace' => 'Cabinet',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'IndexController@index')->name('cabinet.index');
    Route::post('/', 'IndexController@index')->name('cabinet.index.sort');

    Route::get('/task/create', 'TaskController@create')->name('cabinet.task.create');
    Route::post('/task/store', 'TaskController@store')->name('cabinet.task.store');
    Route::post('/task/update', 'TaskController@update')->name('cabinet.task.update');
    Route::get('/task/{task}', 'TaskController@detail')->name('cabinet.task.detail');

    Route::post('/task/', 'SubTaskController@update')->name('cabinet.task.subtask.store');
    Route::get('/task/{task}/comment/create', 'CommentController@create')->name('cabinet.task.comment.create');

    Route::post('/task/image/add/{task}', 'ImageController@add')->name('cabinet.task.image.add');
    Route::post('/task/image/delete', 'ImageController@delete')->name('cabinet.task.image.delete');

    Route::post('/task/sub-task/add/{task}', 'SubTaskController@add')->name('cabinet.task.subtask.add');
});

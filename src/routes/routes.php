<?php

Route::group(['middleware' => config('tracker.middlewares'), 'prefix' => config('tracker.prefix'), 'namespace' => 'Salem\Tracker\Controls\Http\Controllers'], function (){
    
    Route::get('/all', 'TrackerController@index')->name('tracker.get.all');
    Route::post('/save', 'TrackerController@store')->name('tracker.post.save');
    Route::get('/save', 'TrackerController@store')->name('tracker.get.save');
    Route::get('/show/{id}', 'TrackerController@show')->name('tracker.get.show');
    Route::get('/ip/{id}', 'TrackerController@getIp')->name('tracker.get.ip');

});
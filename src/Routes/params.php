<?php

use ElephantsGroup\Params\Controllers;

Route::group(['middleware' => ['web', 'role:params-admin']], function () {
    Route::resource('params/unit', 'ElephantsGroup\Params\Controllers\UnitController');

    Route::get('params/parameter/{id}/enable', 'ElephantsGroup\Params\Controllers\ParameterController@enable');
    Route::get('params/parameter/{id}/disable', 'ElephantsGroup\Params\Controllers\ParameterController@disable');
    Route::resource('params/parameter', 'ElephantsGroup\Params\Controllers\ParameterController');
});


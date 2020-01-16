<?php

use ElephantsGroup\Params\Controllers;

Route::group(['middleware' => ['web', 'role:params-admin']], function () {
    Route::resource('params/unit', 'ElephantsGroup\Params\Controllers\UnitController');

    Route::get('params/parameter/{id}/enable', 'ElephantsGroup\Params\Controllers\ParameterController@enable');
    Route::get('params/parameter/{id}/disable', 'ElephantsGroup\Params\Controllers\ParameterController@disable');
    Route::resource('params/parameter', 'ElephantsGroup\Params\Controllers\ParameterController');

    Route::resource('params/value', 'ElephantsGroup\Params\Controllers\ValueController')->only(['index', 'show', 'create', 'store']);

    Route::get('params/template/{id}/enable', 'ElephantsGroup\Params\Controllers\TemplateController@enable');
    Route::get('params/template/{id}/disable', 'ElephantsGroup\Params\Controllers\TemplateController@disable');
    Route::resource('params/template', 'ElephantsGroup\Params\Controllers\TemplateController');

    Route::resource('params/active-template', 'ElephantsGroup\Params\Controllers\ActiveTemplateController')->only(['index', 'show', 'create', 'store']);

    Route::resource('params/active-parameter', 'ElephantsGroup\Params\Controllers\ActiveParameterController')->only(['index', 'show', 'create', 'store']);
});


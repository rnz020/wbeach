<?php

Route::group(['middleware' => ['web','auth']], function () {

	Route::group(['module' => 'Security', 'namespace' => 'App\Modules\security\Controllers'], function() {

        // Users routes
        Route::get('security/users',                      ['middleware' => [],              'as' => 'security.users',            'uses' => 'UserController@index'  ]);
//        Route::get('security/users/load',               ['middleware' => ['permission:security_users_load'],         'as' => 'security.users.load',       'uses' => 'UserController@load' ]);
//        Route::get('security/users/create',             ['middleware' => ['permission:security_users_create_store'], 'as' => 'security.users.create',     'uses' => 'UserController@create' ]);
//        Route::post('security/users/store',             ['middleware' => ['permission:security_users_create_store'], 'as' => 'security.users.store',      'uses' => 'UserController@store' ]);
//        Route::get('security/users/edit/{user}',        ['middleware' => ['permission:security_users_edit_update'],  'as' => 'security.users.edit',       'uses' => 'UserController@edit'  ]);
//        Route::patch('security/users/edit/{user}',      ['middleware' => ['permission:security_users_edit_update'],  'as' => 'security.users.update',     'uses' => 'UserController@update' ]);
//        Route::get('security/users/show/{user}',        ['middleware' => ['permission:security_users_show'],         'as' => 'security.users.show',       'uses' => 'UserController@show' ]);
//        Route::delete('security/users/destroy/{user}',  ['middleware' => ['permission:security_users_destroy'],      'as' => 'security.users.destroy',    'uses' => 'UserController@destroy' ]);
//        

        
	});

});

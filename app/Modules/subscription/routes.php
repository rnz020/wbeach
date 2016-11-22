<?php

Route::group(['middleware' => ['web','auth']], function () {

    Route::group(['module' => 'Subscription', 'namespace' => 'App\Modules\subscription\Controllers'], function() {
        // Holding routes
        Route::get('subscription/holdings',                       ['middleware' => [],         'as' => 'subscription.holdings',            'uses' => 'HoldingController@index' ]);
        Route::get('subscription/holdings/load',                  ['middleware' => [],         'as' => 'subscription.holdings.load',       'uses' => 'HoldingController@load' ]);
        Route::get('subscription/holdings/create',                ['middleware' => [],         'as' => 'subscription.holdings.create',     'uses' => 'HoldingController@create' ]);
        Route::post('subscription/holdings/store',                ['middleware' => [],         'as' => 'subscription.holdings.store',      'uses' => 'HoldingController@store' ]);
        Route::get('subscription/holdings/edit/{holding}',        ['middleware' => [],         'as' => 'subscription.holdings.edit',       'uses' => 'HoldingController@edit'  ]);
        Route::patch('subscription/holdings/update/{holding}',    ['middleware' => [],         'as' => 'subscription.holdings.update',     'uses' => 'HoldingController@update' ]);
        Route::get('subscription/holdings/show/{holding}',        ['middleware' => [],         'as' => 'subscription.holdings.show',       'uses' => 'HoldingController@show' ]);
        Route::delete('subscription/holdings/destroy/{holding}',  ['middleware' => [],         'as' => 'subscription.holdings.destroy',    'uses' => 'HoldingController@destroy' ]);     
    });

});

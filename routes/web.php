<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
 
    Route::get('/', function () {
        return view('welcome');
      //    return view('auth.login');
    });
    
    // Authentication Routes...
    Route::get('login',  'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('/home', ['',        'as' => 'home',    'uses' => 'HomeController@index' ]);

    
    Route::group(['middleware' => ['auth'], 'namespace' => 'Subscription'], function() {
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
        




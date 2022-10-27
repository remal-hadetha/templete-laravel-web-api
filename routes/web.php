<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['prefix'=>'admin','namespace' => 'Admin'], function () {

    Route::get('login', 'Auth\LoginController@login')->name('admin.login');
    Route::post('login','Auth\LoginController@Auth')->name('admin.auth');


    Route::group(['middleware' => ['admin.auth']], function () {
        Route::get('/'                  , 'Home\HomeController@index' )->name('admin.index');
        Route::get('/logout'            , 'Auth\LoginController@logout' )->name('admin.logout');
        Route::resource('admins'        , 'AdminController'      );
        Route::resource('areas'         , 'AreaController'       );
        Route::resource('brands'        , 'BrandController'      );
        Route::resource('categories'    , 'CategoryController'   );
        Route::resource('cities'        , 'CityController'       );
        Route::resource('countries'     , 'CountryController'    );
        Route::resource('coupons'       , 'CouponController'     );
        Route::resource('contacts'      , 'ContactController'    );
        Route::get('orders/{status}'    , 'OrderController@withStatus')->name('orders.status');
        Route::resource('orders'        , 'OrderController'      );
        Route::resource('products'      , 'ProductController'    );
        Route::resource('reviews'       , 'ReviewController'     );
        Route::post('setting_update'    , 'SettingController@updateSetting')->name('setting_update');
        Route::resource('settings'      , 'SettingController'    );
        Route::resource('sliders'       , 'SliderController'     );
        Route::resource('subcategories' , 'SubCategoryController');
        Route::resource('users'         , 'UserController'       );
        Route::resource('providers'     , 'ProviderController'   );
        Route::resource('services'      , 'ServiceController'    );
        Route::resource('works'         , 'WorkController'       );
        Route::get('reports'            ,'ReportController@index')->name('reports.index');
        Route::get('payments'           ,'PaymentController@index')->name('payments.index');
        Route::get('payments/{id}'      ,'PaymentController@show')->name('payments.show');
        Route::delete('payments/{id}'   ,'PaymentController@destroy')->name('payments.destroy');

    });
});


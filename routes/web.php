<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::match(['get', 'post'], '/upload', 'HomeController@profilePicture')->name('upload.avatar');
Route::match(['get', 'post'], '/edit/profile', 'HomeController@editProfile')->name('edit.profile');

//////Admin Routes///////
Route::group(['middleware' => ['auth', 'verified', 'checkRole:admin']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/admin/settings', 'AdminController@settings')->name('admin.settings');
    Route::get('/admin/check-pwd', 'AdminController@checkPwd')->name('admin.checkPwd');
    Route::post('/admin/update-pwd', 'AdminController@updatePwd')->name('admin.updatePwd');
    Route::resource('users','UserController');
    Route::get('/show/notifications', 'OrderController@allNotifications');
    Route::get('order/notification/{order_id}', 'OrderController@viewOrderNotification')->name('viewOrderNotification');
    Route::get('view/notification/order/{notification_id}', 'HomeController@viewNotification')->name('viewNotifcation');




});

//////Staff Routes///////
Route::group(['middleware' => ['auth', 'verified', 'checkRole:staff,admin']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/admin/settings', 'AdminController@settings')->name('admin.settings');
    Route::get('/admin/check-pwd', 'AdminController@checkPwd')->name('admin.checkPwd');
    Route::post('/admin/update-pwd', 'AdminController@updatePwd')->name('admin.updatePwd');;
    Route::get('order/notification/{order_id}', 'OrderController@viewOrderNotification')->name('viewOrderNotification');
    Route::get('view/notification/order/{notification_id}', 'HomeController@viewNotification')->name('viewNotifcation');


});

//////Customer Routes///////
Route::group(['middleware' => ['auth', 'verified', 'checkRole:staff,admin,customer']], function () {
    // Route::get('view/notification/order/{notification_id}', 'HomeController@viewNotification')->name('viewNotifcation');

});


//////Extra Routes///////
// Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
// Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
// Route::post('/payment/webhook', 'PaymentController@handleWebHook');
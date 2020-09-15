<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/tv', 'TvController@tv')->name('tv');
Route::get('/blog', 'BlogController@blog')->name('blog');
Route::get('/show/post/{id}', 'BlogController@show')->name('show.blog.post');
Route::post('post/comment/{post_id}', 'CommentController@comment')->name('comment.on.post');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::match(['get', 'post'], '/upload', 'HomeController@profilePicture')->name('upload.avatar');
// Route::match(['get', 'post'], '/edit/profile', 'HomeController@editProfile')->name('edit.profile');


///authenticated 
Route::group(['middleware' => ['auth']], function () {
    Route::get('edit/comment/', 'CommentController@edit')->name('edit.comment.on.post');
    // Route::post('edit/comment/{comment_id}', 'CommentController@edit')->name('edit.comment.on.post');
    Route::get('delete/comment/{comment_id}', 'CommentController@delete')->name('delete.comment.on.post');
});


//////Admin Routes///////
Route::group(['middleware' => ['auth', 'verified', 'checkRole:admin']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/admin/settings', 'AdminController@settings')->name('admin.settings');
    Route::get('/admin/check-pwd', 'AdminController@checkPwd')->name('admin.checkPwd');
    Route::post('/admin/update-pwd', 'AdminController@updatePwd')->name('admin.updatePwd');
    Route::resource('users','UserController');
    Route::resource('posts','PostController');
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
    Route::resource('posts','PostController');
    Route::get('order/notification/{order_id}', 'OrderController@viewOrderNotification')->name('viewOrderNotification');
    Route::get('view/notification/order/{notification_id}', 'HomeController@viewNotification')->name('viewNotifcation');


});

//////Customer Routes///////
Route::group(['middleware' => ['auth', 'verified', 'checkRole:staff,admin,customer']], function () {
    // Route::get('view/notification/order/{notification_id}', 'HomeController@viewNotification')->name('viewNotifcation');

});

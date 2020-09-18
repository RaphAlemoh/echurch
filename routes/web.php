<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/tv', 'TvController@tv')->name('tv');
Route::get('/blog', 'BlogController@blog')->name('blog');
Route::get('/media', 'MediaController@media')->name('media');
Route::get('/show/post/{id}', 'BlogController@show')->name('show.blog.post');
Route::post('post/comment/{post_id}', 'CommentController@comment')->name('comment.on.post');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::match(['get', 'post'], '/upload', 'HomeController@profilePicture')->name('upload.avatar');
// Route::match(['get', 'post'], '/edit/profile', 'HomeController@editProfile')->name('edit.profile');


///authenticated 
Route::group(['middleware' => ['auth']], function () {
    Route::get('edit/comment/', 'CommentController@edit');
    Route::post('update/comment', 'CommentController@update');
    Route::get('delete/comment/{comment_id}', 'CommentController@delete');
    Route::post('reply/comment/{reply_id}', 'ReplyController@reply');
    Route::get('edit/reply', 'ReplyController@edit');
    Route::post('update/reply', 'ReplyController@update');
    Route::get('delete/reply/{reply_id}', 'ReplyController@delete');
});


//////Admin Routes///////
Route::group(['middleware' => ['auth', 'verified', 'checkRole:admin']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/admin/settings', 'AdminController@settings')->name('admin.settings');
    Route::get('/admin/check-pwd', 'AdminController@checkPwd')->name('admin.checkPwd');
    Route::post('/admin/update-pwd', 'AdminController@updatePwd')->name('admin.updatePwd');
    Route::resource('users','UserController');
    Route::resource('posts','PostController');
    Route::resource('tvs','TvController');
    Route::resource('medias','MediaController');
    Route::get('/unapproved/comment/{comment_id}', 'CommentController@showCommentToApprove');
    Route::get('approve/comment/{comment_id}', 'CommentController@approveComment');

});

//////Staff Routes///////
Route::group(['middleware' => ['auth', 'verified', 'checkRole:staff,admin']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/admin/settings', 'AdminController@settings')->name('admin.settings');
    Route::get('/admin/check-pwd', 'AdminController@checkPwd')->name('admin.checkPwd');
    Route::post('/admin/update-pwd', 'AdminController@updatePwd')->name('admin.updatePwd');;
    Route::resource('posts','PostController');
    Route::resource('tvs','TvController');
    Route::resource('medias','MediaController');
    Route::get('/unapproved/comment/{comment_id}', 'CommentController@showCommentToApprove');
    Route::get('approve/comment/{comment_id}', 'CommentController@approveComment');
});

//////Customer Routes///////
Route::group(['middleware' => ['auth', 'verified', 'checkRole:staff,admin,customer']], function () {

});

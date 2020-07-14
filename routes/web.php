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

Route::redirect('/', '/posts');
Route::redirect('/home', '/posts');
Route::get('/posts', 'PostController@index');

Route::get('/posts/create', 'PostController@createView');
Route::post('/posts/create','PostController@create');
//Route::post('/posts', 'PostController@store');

Route::patch('/users/{id}', 'UserController@update')->name('users.update');
Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');

Route::delete('users/{id}','UserController@destroy')->name('users.destroy');
Route::delete('posts/{post}','PostController@destroy')->name('post.destroy');

Route::post('/posts/myPosts','PostController@userPosts');
Route::get('/posts/{id}','PostController@show')->name('post');
Route::post('/comments', 'CommentController@store');

Route::get('/today','PostController@today');

Route::get('sendmail', function () {

    $data = array(
        'name' => "Postea",
    );

    Mail::send('emails.welcome', $data, function ($message) {
        $message->from('eduardo@hotmail.com', 'Correo de Bienvenida');
        $message->to('eduardo@hotmail.com')->subject('test email Correo de Bienvenida');
    });
    return "Email de bienvenida enviado exitosamente";
});

Route::get('/notifications/{id}', 'UserController@showNotifications');

/*
Route::get('/', 'PostController@index');
Route::view('/posts/create','create');
Route::post('/posts/create','PostController@create');
Route::get('/posts/{id}', 'PostController@show')->name('post');
*/
Auth::routes();
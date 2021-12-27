<?php

use App\Http\Controllers\aController;
use App\Http\Middleware\Authorization;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function() {
    return Str::random(32);
});

$router->get('/sebuahapi', 'aController@index');

$router->post('/luaslingkaran', 'aController@luaslingkaran');

$router->post('/test', function() {
    return 'POST';
});

$router->get('/get', function() {
    return 'Ini kalo method GET';
});

$router->post('/post', function() {
    return 'Kalo ini POST';
});

$router->put('/put', function() {
    return 'Nah, ini PUT';
});

$router->patch('/patch', function() {
    return 'Kalo PATCH kayak gini';
});

$router->delete('/delete', function() {
    return 'ini DELETE';
});

$router->options('/options', function() {
    return 'Yang ini OPTIONS';
});

//dynamic route
//1 variabel
// $router->get('/user/{id}', function($id) {
//     return 'User ID = ' . $id;
// });

//2 variabel
$router->get('/post/{postID}/comments/{commentID}', function($postID, $commentID){
    return 'Post ID = ' . $postID . ' Comment ID = ' . $commentID;
});

//optional route
$router->get('/menu[/{menu}]', function($menu = null) {
    return $menu === null ? 'Bakso, Mie Ayam, Martabak' : 'Menu pilihan : ' . $menu;
});

//aliases route
$router->get('/hasil', ['as' => 'route.hasil.test', function() {
    return 'Tidak lulus';
}]);

$router->get('/test', function(Request $request) {
    $sesuatu = $request->nilai;
    if ($sesuatu < 65){
        return redirect()->route('route.hasil.test');
    }
    return 'Lulus!';
});

//group route
$router->group(['prefix' => 'users'], function () use ($router) {
    $router->get('/', function () {
        return "GET /users";
    });
});

//middleware
$router->get('/admin/home/', ['middleware' => 'age', function(){
    return 'Dewasa';
}]);

$router->get('/fail', function(){
    return 'Dibawah Umur';
});

//percobaan

//API menampilkan list user
$router->get('/show', 'aController@show');

//API membuat user baru
$router->post('/create', 'aController@create');

//API mengupdate data user
$router->put('/update/{id}', 'aController@update');

//API menghapus data user
$router->delete('/delete/{id}', 'aController@delete');


//================================================================================//

//API registrasi mahasiswa
$router->post('/registrasi', 'CollegeController@registrasi');

//API krs mahasiswa
$router->post('/krs', 'CollegeController@krs');

//API menampilkan data krs mahasiswa
$router->get('/data', 'CollegeController@showdata');

//API menampilkan data mahasiswa belum bayar
$router->get('/info', 'CollegeController@showinfo');

//--------------------------------------------------------------------------------------//
//API sambutan
$router->get('/index', 'ChallengeController@index');

//API sambutan 2
$router->get('/hello', ['uses' => 'ChallengeController@hello']);

//CHALLENGE
//API menampilkan data
$router->get('/lihat', 'ChallengeController@lihat');

//API menambahkan data
$router->post('/tambah', 'ChallengeController@tambah');

//API mengupdate data
$router->put('/update/{id}', 'ChallengeController@update');

//API menghapus data
$router->delete('/hapus/{id}', 'ChallengeController@hapus');

//------------------------------------------------------------------------------------------//

$router->post('/register', 'AuthController@register');

$router->post('/login', 'AuthController@login');

$router->put('/users/{id}', ['middleware' => 'auth', function(){}]);

$router->put('/users/{id}', ['middleware' => 'auth', 'uses' => 'AuthController@update']);
 
$router->delete('/users/delete/{id}', 'AuthController@delete');



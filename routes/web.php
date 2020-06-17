<?php

use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;
use App\Product;
use App\Category;
use App\Comment;
use App\Reaction;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/Page', function () {
    return view('Page');
});

/*======================================
             Admin panel
=========================================*/

Route::get('/home', 'HomeController@index')->name('home');

//category
Route::resource('Category', 'CategoryController')->middleware(CheckAdmin::class);
Route::post('/visibility', 'CategoryController@visibility')->middleware(CheckAdmin::class);

//subcategory
Route::resource('Subcategory', 'SubcategoryController')->middleware(CheckAdmin::class);
Route::post('/Svisibility', 'SubcategoryController@visibility')->middleware(CheckAdmin::class);

//forum category
Route::resource('Fcategory', 'FcategoriesController')->middleware(CheckAdmin::class);
Route::post('/fvisibility', 'FcategoriesController@visibility')->middleware(CheckAdmin::class);

//user controller
Route::get('/users','HomeController@users');
Route::post('/admin', 'HomeController@admin');

/*======================================
             Admin panel
=========================================*/

/*======================================
             Smart Market
=========================================*/


//market landing page
Route::get('/Market', function () {
    $products=Product::simplePaginate(20);
    $categories=Category::all();
    return view('homepage',['products'=>$products,'categories'=>$categories]);
});

//upload product
Route::resource('Product', 'ProductController');
Route::get('/subcategory/{id}','ProductController@getsubcategory');



/*======================================
             Smart Investors
=========================================*/

Route::resource('Investment', 'ForumController');

Route::get('search','PostsController@search');


Route::get('Post/{id}', 'ForumController@post');

Route::post('/like', 'PostsController@like');

Route::post('/pin', 'PostsController@post');



Route::post('/dislike', 'PostsController@dislike');

Route::get('/reaction', 'PostsController@show');


//facebook

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

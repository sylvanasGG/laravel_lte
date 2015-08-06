<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@getIndex');


Route::controllers([  
  'admin'   => 'AdminController',
  'user'    => 'UserController',
  'auth'    => 'AuthController',
  'article' => 'ArticleController',
  'comment' => 'CommentController',
  'test'    => 'TestController',
   'home' => 'HomeController',
    'release' => 'Home\ReleaseController'
]);

/**
 * 前台路由组
 */
//Route::group(array('prefix' => 'home'), function()
//{
//    $HomeController = 'HomeController@';
//    //
//    Route::get('article/{$id}', $HomeController.'getArticle');
//    Route::post('comment/{$id}', $HomeController.'postComment');
//
//});

/**
 * 管理权限路由组
 */
Route::group(array('prefix' => 'perm'), function()
{
    $PermController = 'PermController@';
    //团队职务
    Route::get('groupList', $PermController.'getGroupList');
    Route::post('groupList', $PermController.'postGroupList');
    Route::get('group/{id}', $PermController.'getGroup');
    Route::post('group/{id}', $PermController.'postGroup');

});
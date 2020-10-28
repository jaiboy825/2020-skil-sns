<?php

use Gondr\App\Route;

if(isset($_SESSION['user'])){
    //로그인 완료일때
    Route::get('/user/logout', 'UserController@logout');
    Route::post('/write','MainController@indexPost');
    Route::get('/user/profile','UserController@profile');
    Route::post('/comt','MainController@indexComment');
    Route::post('/comts', 'MainController@indexComments');
    Route::post('/', 'MainController@indexLike');
    Route::post('/del','MainController@deletePost');
    Route::post('/delc','MainController@deleteComment');
    Route::post('/inp', 'MainController@indexProfileImg');
    
}else {
    //비로그인일때
      
    Route::post('/main/register', 'UserController@registerProcess');
    Route::post('/main/login', 'UserController@loginProcess');
    // Route::get('/login', "UserController@login");
}
//항상

Route::get('/', 'MainController@index');
if(!isset($_SESSION['user'])) {
    Route::post('/', 'MainController@indexProcess');
}
//  else {
//     Route::post('/', 'MainController@indexPost');
// }

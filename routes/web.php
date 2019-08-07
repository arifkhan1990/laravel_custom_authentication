<?php



Route::get('/register', 'RegistrationController@create');
Route::post('register', 'RegistrationController@store');

Route::get('/', 'SessionController@create');
Route::get('/login', 'SessionController@create');
Route::post('/login', 'SessionController@store');
Route::get('/logout', 'SessionController@destroy');
    
Route::get('/user/verify/{token}', 'RegistrationController@verifyUser');
<?php

Route::get('/','LoginController@index')->name('login');
Route::get('login','LoginController@index')->name('login');

Route::get('home', function () {
    return view('home');
});

Route::get('lancar-ferias', function () {
    return view('lancarferias');
});

Route::any('equipe/busca','EquipeController@busca')->name('equipe.busca');
Route::resource('equipe','EquipeController');

<?php

use Illuminate\Support\Facades\Route;

//
// Formulário de Criação da Mensagem
//
Route::get('/', 'App\Http\Controllers\Main@index')->name('main_index');
Route::post('/init','App\Http\Controllers\Main@init')->name('main_init');

//
// Confirmação do Envio de Mensagem
//
Route::get('/confirm/{purl}', 'App\Http\Controllers\Main@confirm')->name('main_confirm');

//
// Leitura da Mensagem
//
Route::get('/read/{purl}', 'App\Http\Controllers\Main@read')->name('main_read');

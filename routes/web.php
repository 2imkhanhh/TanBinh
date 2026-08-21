<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/gioi-thieu', function () {
    return view('gioi-thieu');
});

Route::get('/san-pham', function () {
    return view('san-pham');
});

Route::get('/san-pham-chi-tiet', function () {
    return view('san-pham-chi-tiet');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/blog-tin-tuc', function () {
    return view('blog-tin-tuc');
});

Route::get('/blog-khac', function () {
    return view('blog-khac');
});

Route::get('/lien-he', function () {
    return view('lien-he');
});

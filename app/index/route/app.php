<?php

use think\facade\Route;

Route::rule('/', 'index/index');
Route::get('category/:type', 'index/Index/index');
Route::get('info/:id', 'index/Info/index');
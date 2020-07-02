<?php

use think\facade\Route;

Route::rule('/', 'index/index');
Route::any('category/:type', 'index/Index/index');
Route::any('info/:id', 'index/Info/index');

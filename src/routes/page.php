<?php

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'BrandStudio\Page\Http\Controllers',
], function () { // custom admin routes
    Route::crud('page', 'PageCrudController');
});

<?php

return [
    'page_class' => \BrandStudio\Page\Page::class,
    'templates_path' => 'Templates',
    'prefix' => 'api/page',
    'middleware' => 'api',

    'sidebar_icon' => 'fa fa-question',

    'use_backpack' => true,
    'crud_middleware' => false,//'role:admin|developer|manager',
];

<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group([], function (Router $router) {
    $router->get(LaravelLocalization::transRoute('faq::routes.faq.index'), [
        'uses' => 'PublicController@index',
        'as'   => 'faq.index'
    ]);
    $router->get(LaravelLocalization::transRoute('faq::routes.faq.slug'), [
        'uses' => 'PublicController@view',
        'as'   => 'faq.slug'
    ]);
    $router->get(LaravelLocalization::transRoute('faq::routes.faq.category'), [
        'uses' => 'PublicController@category',
        'as'   => 'faq.category'
    ]);
});
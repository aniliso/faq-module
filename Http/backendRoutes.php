<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/faq'], function (Router $router) {
    $router->bind('faq', function ($id) {
        return app('Modules\Faq\Repositories\FaqRepository')->find($id);
    });
    $router->get('faqs', [
        'as' => 'admin.faq.faq.index',
        'uses' => 'FaqController@index',
        'middleware' => 'can:faq.faqs.index'
    ]);
    $router->get('faqs/create', [
        'as' => 'admin.faq.faq.create',
        'uses' => 'FaqController@create',
        'middleware' => 'can:faq.faqs.create'
    ]);
    $router->post('faqs', [
        'as' => 'admin.faq.faq.store',
        'uses' => 'FaqController@store',
        'middleware' => 'can:faq.faqs.create'
    ]);
    $router->get('faqs/{faq}/edit', [
        'as' => 'admin.faq.faq.edit',
        'uses' => 'FaqController@edit',
        'middleware' => 'can:faq.faqs.edit'
    ]);
    $router->put('faqs/{faq}', [
        'as' => 'admin.faq.faq.update',
        'uses' => 'FaqController@update',
        'middleware' => 'can:faq.faqs.edit'
    ]);
    $router->delete('faqs/{faq}', [
        'as' => 'admin.faq.faq.destroy',
        'uses' => 'FaqController@destroy',
        'middleware' => 'can:faq.faqs.destroy'
    ]);
    $router->bind('faqCategory', function ($id) {
        return app('Modules\Faq\Repositories\CategoryRepository')->find($id);
    });
    $router->get('categories', [
        'as' => 'admin.faq.category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:faq.categories.index'
    ]);
    $router->get('categories/create', [
        'as' => 'admin.faq.category.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:faq.categories.create'
    ]);
    $router->post('categories', [
        'as' => 'admin.faq.category.store',
        'uses' => 'CategoryController@store',
        'middleware' => 'can:faq.categories.create'
    ]);
    $router->get('categories/{faqCategory}/edit', [
        'as' => 'admin.faq.category.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:faq.categories.edit'
    ]);
    $router->put('categories/{faqCategory}', [
        'as' => 'admin.faq.category.update',
        'uses' => 'CategoryController@update',
        'middleware' => 'can:faq.categories.edit'
    ]);
    $router->delete('categories/{faqCategory}', [
        'as' => 'admin.faq.category.destroy',
        'uses' => 'CategoryController@destroy',
        'middleware' => 'can:faq.categories.destroy'
    ]);
// append


});

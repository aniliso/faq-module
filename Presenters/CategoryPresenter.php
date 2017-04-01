<?php namespace Modules\Faq\Presenters;

use Modules\Core\Presenters\BasePresenter;

class CategoryPresenter extends BasePresenter
{
    protected $zone     = 'faqCategoryImage';
    protected $slug     = 'slug';
    protected $transKey = 'faq::routes.faq.category';
    protected $routeKey = 'faq.category';
}
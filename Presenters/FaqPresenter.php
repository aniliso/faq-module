<?php namespace Modules\Faq\Presenters;

use Modules\Core\Presenters\BasePresenter;

class FaqPresenter extends BasePresenter
{
    protected $zone     = 'faqImage';
    protected $slug     = 'slug';
    protected $transKey = 'faq::routes.faq.slug';
    protected $routeKey = 'faq.slug';
}
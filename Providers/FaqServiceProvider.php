<?php

namespace Modules\Faq\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Faq\Events\Handlers\RegisterFaqSidebar;

class FaqServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        $this->app['events']->listen(
            BuildingSidebar::class,
            $this->getSidebarClassForModule('faq', RegisterFaqSidebar::class)
        );
    }

    public function boot()
    {
        $this->publishConfig('faq', 'permissions');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Faq\Repositories\FaqRepository',
            function () {
                $repository = new \Modules\Faq\Repositories\Eloquent\EloquentFaqRepository(new \Modules\Faq\Entities\Faq());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Faq\Repositories\Cache\CacheFaqDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Faq\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Faq\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Faq\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Faq\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
    }
}

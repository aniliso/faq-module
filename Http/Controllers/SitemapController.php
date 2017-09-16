<?php namespace Modules\Faq\Http\Controllers;

use Illuminate\Http\Response;
use Modules\Sitemap\Entities\Helpers\SitemapFrequency;
use Modules\Faq\Repositories\CategoryRepository;
use Modules\Sitemap\Http\Controllers\BaseSitemapController;

class SitemapController extends BaseSitemapController
{
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->category = $category;
        $this->sitemap->setCache('laravel.faq.sitemap', $this->sitemapCachePeriod);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        foreach ($this->category->all() as $category)
        {
            $this->sitemap->add(
                $category->url,
                $category->updated_at,
                0.9,
                SitemapFrequency::WEEKLY,
                [],
                null,
                $category->present()->languages('language')
            );
            if($category->faqs()->exists())
            {
                foreach ($category->faqs()->get() as $faq) {
                    $images = [];
                    if(isset($faq->thumbnail))
                    {
                        $images[] = ['url' => $faq->thumbnail, 'title' => $faq->fullname];
                    }
                    $this->sitemap->add(
                        $faq->url,
                        $faq->updated_at,
                        0.9,
                        SitemapFrequency::WEEKLY,
                        $images,
                        null,
                        $faq->present()->languages('language')
                    );
                }
            }
        }
        return $this->sitemap->render('xml');
    }
}

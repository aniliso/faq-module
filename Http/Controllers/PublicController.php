<?php namespace Modules\Faq\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Faq\Entities\Faq;
use Modules\Faq\Repositories\CategoryRepository;
use Modules\Faq\Repositories\FaqRepository;
use Breadcrumbs;

class PublicController extends BasePublicController
{
    /**
     * @var FaqRepository
     */
    private $faq;
    /**
     * @var CategoryRepository
     */
    private $category;

    private $perPage = 20;

    public function __construct(FaqRepository $faq, CategoryRepository $category)
    {
        parent::__construct();
        $this->faq = $faq;
        $this->category = $category;

        /* Start Default Breadcrumbs */
        if(!app()->runningInConsole()) {
            Breadcrumbs::register('faq.index', function($breadcrumbs) {
                $breadcrumbs->push(trans('themes::faq.title'), route('faq.index'));
            });
        }
        /* End Default Breadcrumbs */
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $faqs = $this->faq->allTranslatedInPaginate(locale(), $this->perPage);
        $categories = $this->category->all()->where('status', 1);

        /* Start Seo */
        $title = trans('themes::faq.title');
        $url   = getURLFromRouteNameTranslated($this->locale, 'faq::routes.faq.index');

        $this->setUrl($url)
            ->addMeta('robots', "follow, index")
            ->addAlternates($this->getAlternateLanguages('faq::routes.faq.index'));

        $this->setTitle($title)
             ->setDescription('themes::faq.description');
        /* End Seo */

        return view('faq::index', compact('faqs', 'categories'));
    }

    public function view($slug)
    {
        $faq = $this->faq->findBySlug($slug);
        $categories = $this->category->all()->where('status', 1);

        /* Start Seo */
        $this->setUrl($faq->url)
            ->addMeta('robots', "follow, index");

        $this->setTitle($faq->title)
             ->setDescription($faq->content);
        /* End Seo */

        /* Start Breadcrumbs */
        Breadcrumbs::register('faq.view', function($breadcrumbs) use ($faq) {
            $breadcrumbs->parent('faq.index');
            if(isset($faq->category)) $breadcrumbs->push($faq->category->name, $faq->category->url);
            $breadcrumbs->push($faq->title, $faq->url);
        });
        /* End Breadcrumbs */

        return view('faq::view', compact('faq', 'categories'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function category($slug)
    {
        $category = $this->category->findBySlug($slug);
        $categories = $this->category->all()->where('status', 1);
        $faqs = $category->faqs()->paginate($this->perPage);

        /* Start Seo */
        $title = $category->meta_title ? $category->meta_title : $category->name;

        $this->setUrl($category->url)
            ->addMeta('robots', "follow, index");

        $this->setTitle($title)
             ->setDescription('themes::faq.description');
        /* End Seo */

        /* Start Breadcrumbs */
        Breadcrumbs::register('faq.category', function($breadcrumbs) use ($category) {
            $breadcrumbs->parent('faq.index');
            $breadcrumbs->push($category->name, $category->url);
        });
        /* End Breadcrumbs */

        return view('faq::category', compact('faqs', 'category', 'categories'));
    }
}

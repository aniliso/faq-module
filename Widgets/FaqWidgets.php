<?php namespace Modules\Faq\Widgets;

use Modules\Faq\Repositories\CategoryRepository;
use Modules\Faq\Repositories\FaqRepository;

class FaqWidgets
{
    /**
     * @var CategoryRepository
     */
    private $category;
    /**
     * @var FaqRepository
     */
    private $faq;

    public function __construct(CategoryRepository $category, FaqRepository $faq)
    {
        $this->category = $category;
        $this->faq = $faq;
    }

    public function faqs($limit=5, $view="latest")
    {
        $faqs = $this->faq->all()->take($limit);
        if($faqs->count()>0) {
            return view('faq::widgets.'.$view, compact('faqs'));
        }
        return false;
    }

    public function latestFaqs($slug='', $limit=5, $view='latest-faqs')
    {
        $category = $this->category->findBySlug($slug);
        if(isset($category)) {
            $faqs = $category->faqs()->get()->take($limit);
            return view('faq::widgets.'.$view, compact('category', 'faqs'))->render();
        }
        return false;
    }

    public function categories($view='category-lists')
    {
        $categories = $this->category->all();
        if(isset($categories)) {
            return view('faq::widgets.'.$view, compact('categories'))->render();
        }
        return false;
    }

    public function category($slug="", $view='category')
    {
        if($category = $this->category->findBySlug($slug))
        {
            return view('faq::widgets.'.$view, compact('category'))->render();
        }
        return false;
    }
}

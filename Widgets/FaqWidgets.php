<?php namespace Modules\Faq\Widgets;

use Modules\Faq\Repositories\CategoryRepository;

class FaqWidgets
{
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
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
}
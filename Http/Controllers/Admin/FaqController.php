<?php

namespace Modules\Faq\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Faq\Entities\Faq;
use Modules\Faq\Entities\Status;
use Modules\Faq\Http\Requests\CreateFaqRequest;
use Modules\Faq\Http\Requests\UpdateFaqRequest;
use Modules\Faq\Repositories\CategoryRepository;
use Modules\Faq\Repositories\FaqRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class FaqController extends AdminBaseController
{
    /**
     * @var FaqRepository
     */
    private $faq;
    /**
     * @var Status
     */
    private $status;
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(FaqRepository $faq, Status $status, CategoryRepository $category)
    {
        parent::__construct();

        $this->faq = $faq;
        $this->status = $status;
        $this->category = $category;

        view()->share('statuses', $status->lists());
        view()->share('categoryLists', $this->category->all()->pluck('name', 'id')->toArray());
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $faqs = $this->faq->all();

        return view('faq::admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('faq::admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(CreateFaqRequest $request)
    {
        $faq = $this->faq->create($request->all());

        if($request->has('category_id'))
        {
            $category = $this->category->find($request->category_id);
            $faq->category()->associate($category);
            $faq->save();
        }

        return redirect()->route('admin.faq.faq.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('faq::faqs.title.faqs')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Faq $faq
     * @return Response
     */
    public function edit(Faq $faq)
    {
        return view('faq::admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Faq $faq
     * @param  Request $request
     * @return Response
     */
    public function update(Faq $faq, UpdateFaqRequest $request)
    {
        $this->faq->update($faq, $request->all());

        if($request->has('category_id'))
        {
            $category = $this->category->find($request->category_id);
            $faq->category()->associate($category);
            $faq->save();
        }

        return redirect()->route('admin.faq.faq.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('faq::faqs.title.faqs')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Faq $faq
     * @return Response
     */
    public function destroy(Faq $faq)
    {
        $this->faq->destroy($faq);

        return redirect()->route('admin.faq.faq.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('faq::faqs.title.faqs')]));
    }
}

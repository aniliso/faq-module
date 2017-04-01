<?php

namespace Modules\Faq\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Modules\Faq\Entities\Status;
use Modules\Faq\Events\FaqWasCreated;
use Modules\Faq\Events\FaqWasDeleted;
use Modules\Faq\Events\FaqWasUpdated;
use Modules\Faq\Repositories\FaqRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentFaqRepository extends EloquentBaseRepository implements FaqRepository
{
    public function all()
    {
        return $this->model->orderBy('ordering', 'ASC')->with('translations')->get();
    }

    public function create($data)
    {
        $faq = $this->model->create($data);

        event(new FaqWasCreated($faq, $data));

        return $faq;
    }

    public function update($model, $data)
    {
        $model->update($data);

        event(new FaqWasUpdated($model, $data));

        return $model;
    }

    public function destroy($model)
    {
        event(new FaqWasDeleted($model->id, get_class($model)));
        return parent::destroy($model);
    }

    /**
     * @param $lang
     * @param $per_page
     * @return mixed
     */
    public function allTranslatedInPaginate($lang, $per_page)
    {
        return $this->model->whereHas('translations', function (Builder $q) use ($lang) {
            $q->where('locale', "$lang");
            $q->where('title', '!=', '');
        })->with('translations')->whereStatus(Status::PUBLISHED)->orderBy('created_at', 'DESC')->paginate($per_page);
    }
}

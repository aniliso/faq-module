<?php

namespace Modules\Faq\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface FaqRepository extends BaseRepository
{
    /**
     * @param $lang
     * @param $per_page
     * @return mixed
     */
    public function allTranslatedInPaginate($lang, $per_page);
}

<?php

namespace Modules\Faq\Repositories\Cache;

use Modules\Faq\Repositories\FaqRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheFaqDecorator extends BaseCacheDecorator implements FaqRepository
{
    public function __construct(FaqRepository $faq)
    {
        parent::__construct();
        $this->entityName = 'faq.faqs';
        $this->repository = $faq;
    }

    /**
     * @param $lang
     * @param $per_page
     * @return mixed
     */
    public function allTranslatedInPaginate($lang, $per_page)
    {
        $page = \Request::has('page') ? \Request::query('page') : 1;
        return $this->cache
            ->tags($this->entityName, 'global')
            ->remember("{$this->locale}.{$this->entityName}.allTranslatedInPaginate.{$lang}.{$per_page}.{$page}", $this->cacheTime,
                function () use ($lang, $per_page) {
                    return $this->repository->allTranslatedInPaginate($lang, $per_page);
                }
            );
    }
}

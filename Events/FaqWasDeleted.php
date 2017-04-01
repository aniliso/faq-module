<?php namespace Modules\Faq\Events;

use Modules\Media\Contracts\DeletingMedia;

class FaqWasDeleted implements DeletingMedia
{
    private $faqId;
    private $faqClass;

    /**
     * FaqWasDeleted constructor.
     * @param $faqId
     * @param $faqClass
     */
    public function __construct($faqId, $faqClass)
    {

        $this->faqId = $faqId;
        $this->faqClass = $faqClass;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->faqId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->faqClass;
    }
}

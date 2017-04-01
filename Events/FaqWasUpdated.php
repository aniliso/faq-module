<?php namespace Modules\Faq\Events;

use Modules\Faq\Entities\Faq;
use Modules\Media\Contracts\StoringMedia;

class FaqWasUpdated implements StoringMedia
{
    /**
     * @var array
     */
    private $data;
    /**
     * @var Faq
     */
    private $faq;

    /**
     * FaqWasUpdated constructor.
     * @param Faq $faq
     * @param array $data
     */
    public function __construct(Faq $faq, array $data)
    {
        $this->data = $data;
        $this->faq = $faq;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->faq;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}

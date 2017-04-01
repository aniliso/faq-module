<?php namespace Modules\Faq\Events;

use Modules\Media\Contracts\StoringMedia;

class FaqWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    private $data;
    /**
     * @var
     */
    private $faq;

    /**
     * FaqWasCreated constructor.
     * @param $faq
     * @param array $data
     */
    public function __construct($faq, array $data)
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

<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'slug', 'content', 'meta_title', 'meta_description'];
    protected $table = 'faq__faq_translations';

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return localize_trans_url($this->locale, 'faq::routes.faq.slug', ['slug'=>$this->slug]);
    }
}

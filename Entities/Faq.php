<?php

namespace Modules\Faq\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Faq\Presenters\FaqPresenter;
use Modules\Media\Support\Traits\MediaRelation;

class Faq extends Model
{
    use Translatable, MediaRelation, PresentableTrait;

    protected $table = 'faq__faqs';
    public $translatedAttributes = ['title', 'slug', 'content', 'meta_title', 'meta_description'];
    protected $fillable = ['title', 'slug', 'content', 'meta_title', 'meta_description', 'ordering', 'status'];

    protected $presenter = FaqPresenter::class;

    protected $with = ['files'];

    protected $casts = [
      'status' => 'int'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->with('translations');
    }

    public function hasImage()
    {
        return $this->files()->exists();
    }

    public function getUrlAttribute()
    {
        return route('faq.slug', $this->slug);
    }
}

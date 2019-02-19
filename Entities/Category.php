<?php

namespace Modules\Faq\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Models\Scopes\ActiveScope;
use Modules\Faq\Presenters\CategoryPresenter;

class Category extends Model
{
    use Translatable, PresentableTrait;

    protected $table = 'faq__categories';
    public $translatedAttributes = ['name', 'slug', 'meta_title', 'meta_description'];
    protected $fillable = ['name', 'slug', 'meta_title', 'meta_description', 'ordering', 'status'];
    protected $presenter = CategoryPresenter::class;

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'category_id', 'id')->with('translations');
    }

    public function getUrlAttribute()
    {
        return localize_trans_url(locale(), 'faq::routes.faq.category', ['slug'=>$this->slug]);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope());
    }
}

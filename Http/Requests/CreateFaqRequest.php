<?php

namespace Modules\Faq\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateFaqRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'faq::faqs.form';

    public function translationRules()
    {
        return [
          'title' => 'required',
          'content' => 'required'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|integer',
            'ordering'    => 'required'
        ];
    }

    public function attributes()
    {
        return trans('faq::faqs.form');
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}

<div class="box-body">
    {!! Form::i18nInput("title", trans('faq::faqs.form.title'), $errors, $lang, null, ['data-slug'=>'source']) !!}

    {!! Form::i18nInput("slug", trans('faq::faqs.form.slug'), $errors, $lang, null, ['data-slug'=>'target']) !!}

    {!! Form::i18nTextarea("content", trans('faq::faqs.form.content'), $errors, $lang) !!}
</div>

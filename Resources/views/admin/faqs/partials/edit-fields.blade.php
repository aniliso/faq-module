<div class="box-body">
    {!! Form::i18nInput("title", trans('faq::faqs.form.title'), $errors, $lang, $faq, ['data-slug'=>'source']) !!}

    {!! Form::i18nInput("slug", trans('faq::faqs.form.slug'), $errors, $lang, $faq, ['data-slug'=>'target']) !!}

    {!! Form::i18nTextarea("content", trans('faq::faqs.form.content'), $errors, $lang, $faq) !!}
</div>

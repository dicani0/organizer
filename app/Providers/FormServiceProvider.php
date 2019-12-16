<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.form.text', ['name', 'value' => null, 'attributes' => []]);
        Form::component('bsTextArea', 'components.form.textarea', ['name', 'value' => null, 'attributes' => []]);
        Form::component('bsSubmit', 'components.form.submit', ['value' => 'Submit', 'attributes' => []]);
        Form::component('hidden', 'components.form.hidden', ['name', 'value' => null, 'attributes' => []]);
        Form::component('dropdown', 'components.form.dropdown', ['name', 'value', 'attributes' => []]);
        Form::component('file', 'components.form.file', ['name', 'attributes' =>[]]);
        Form::component('bsColor', 'component.form.color', ['name', 'attributes' =>[]]);
        Form::component('bsDate', 'component.form.date', ['name', 'attributes' =>[]]);
    }
}

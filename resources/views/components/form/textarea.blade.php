<div class="form-group">
    {{ Form::label($name, $attributes['label'] ?? null, ['class' => 'control-label']) }}
    {{ Form::textArea($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
</div>

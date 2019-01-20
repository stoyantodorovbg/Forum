@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.labels.update', ['id' => $label->id]) }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_label') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.labels') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/labels">{{ label('save_exit') }}</button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('status') }}</label>
                <select class="form-control" name="status">
                    <option {{ $label->status ? 'selected' : '' }} value="1">
                        {{ label('active') }}
                    </option>
                    <option {{ !$label->status ? 'selected' : '' }} value="0">
                        {{ label('inactive') }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('system_name') }}</label>
                <div>
                    <input class="form-control" name="system_name" value="{{ $label->system_name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('body') }}</label>
                <div>
                    <input class="form-control" name="default_content" value="{{ $label->default_content }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('default_label_language') }}</label>
                <select class="form-control" name="default_language_id">
                    @foreach($languages as $language)
                        <option {{ $language->id == $label->default_language_id ? "selected" : ""}}
                            value="{{ $language->id }}">
                            {{ ucfirst($language->title) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="font-weight-bold">{{ label('translations') }}</div>
            <translation-table :translations="{{ $translations }}"
                :languages="{{ $languages }}"
                :item="{{ $label }}"
                :labels="{
                     'language': '{{ label('language') }}',
                     'add_a_translation': '{{ label('add_a_translation') }}',
                     'language': '{{ label('language') }}',
                     'body': '{{ label('body') }}',
                     'save_translation': '{{ label('save_translation') }}',
                     'edit_translation': '{{ label('edit_translation') }}',
                     'edit': '{{ label('edit') }}',
                     'cancel': '{{ label('cancel') }}',
                     'delete': '{{ label('delete') }}',
                }"
                :text_input_labels="{
                     'body': ['{{ label('body') }}', 'content'],
                }"
                :textarea_input_labels="{}"
                :item_name="'label'"
                :text_inputs="['content']"
                :textarea_inputs="[]"
                :url="'/admin/label-translations/'" >
            </translation-table>

            @if($translations->count() == 0)
                <p>{{ label('translations_empty') }}</p>
            @endif
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.labels') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/labels">{{ label('save_exit') }}</button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
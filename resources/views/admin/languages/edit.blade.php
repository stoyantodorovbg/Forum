@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.languages.update', ['slug' => $language->id]) }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_language') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.languages') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/languages">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('language') }}</span>
                <span class="info-data">{{ $language->name }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('created_at') }}</span>
                <span class="info-data">{{ $language->created_at }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('updated_at') }}</span>
                <span class="info-data">{{ $language->updated_at }}</span>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('status') }}</label>
                <select class="form-control" name="status">
                    <option {{ $language->status ? 'selected' : '' }} value="1">
                        {{ label('active') }}
                    </option>
                    <option {{ !$language->status ? 'selected' : '' }} value="0">
                        {{ label('inactive') }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title" value="{{ $language->title }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('short_title') }}</label>
                <div>
                    <input class="form-control" name="short_title" value="{{ $language->short_title }}">
                </div>
            </div>
            <translation-table
                    :translations="{{ $translations }}"
                    :languages="{{ $languages }}"
                    :item="{{ $language }}"
                    :labels="{
                     'language': '{{ label('language') }}',
                     'add_a_translation': '{{ label('add_a_translation') }}',
                     'language': '{{ label('language') }}',
                     'save_translation': '{{ label('save_translation') }}',
                     'edit_translation': '{{ label('edit_translation') }}',
                     'edit': '{{ label('edit') }}',
                     'delete': '{{ label('delete') }}',
                     }"
                    :text_input_labels="{
                     'title': ['{{ label('title') }}', 'title'],
                     'short_title': ['{{ label('short_title') }}', 'short_title'],
                     }"
                    :item_name="'language'"
                    :text_inputs="[
                    'title',
                    'short_title'
                ]"
                    :url="'/admin/language-translations/'" >
            </translation-table>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.languages') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/languages">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
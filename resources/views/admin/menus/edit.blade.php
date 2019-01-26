@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.menus.update', ['id' => $menu->id]) }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_menu') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.menus') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/menus">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('status') }}</label>
                <select class="form-control" name="status">
                    <option {{ $menu->status ? 'selected' : '' }} value="1">
                        {{ label('active') }}
                    </option>
                    <option {{ !$menu->status ? 'selected' : '' }} value="0">
                        {{ label('inactive') }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title" value="{{ $menu->title }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('description') }}</label>
                <div>
                    <textarea class="form-control" rows="10" id="comment" name="description">{{ $menu->description }}</textarea>
                </div>
            </div>
            <translation-table :translations="{{ $translations }}"
                :languages="{{ $languages }}"
                :item="{{ $menu }}"
                :labels="{
                    'language': '{{ label('language') }}',
                    'add_a_translation': '{{ label('add_a_translation') }}',
                    'language': '{{ label('language') }}',
                    'description': '{{ label('description') }}',
                    'save_translation': '{{ label('save_translation') }}',
                    'edit_translation': '{{ label('edit_translation') }}',
                    'edit': '{{ label('edit') }}',
                    'cancel': '{{ label('cancel') }}',
                    'delete': '{{ label('delete') }}',
                }"
                :text_input_labels="{
                    'title': ['{{ label('title') }}', 'title'],
                }"
                :textarea_input_labels="{
                    'description': ['{{ label('description') }}', 'description'],
                }"
                :item_name="'menu'"
                :text_inputs="['title']"
                :textarea_inputs="['description']"
                :url="'/admin/menu-translations/'" >
            </translation-table>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.menus') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/menus">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
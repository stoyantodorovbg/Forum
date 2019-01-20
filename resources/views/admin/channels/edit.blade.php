@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.channels.update', ['slug' => $channel->slug]) }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_channel') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.channels') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/channels">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('channel') }}</span>
                <span class="info-data">{{ $channel->name }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('created_at') }}</span>
                <span class="info-data">{{ $channel->created_at }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('updated_at') }}</span>
                <span class="info-data">{{ $channel->updated_at }}</span>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('status') }}</label>
                <select class="form-control" name="status">
                    <option {{ $channel->status ? 'selected' : '' }} value="1">
                        {{ label('active') }}
                    </option>
                    <option {{ !$channel->status ? 'selected' : '' }} value="0">
                        {{ label('inactive') }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="name" value="{{ $channel->name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('slug') }}</label>
                <div>
                    <input class="form-control" name="slug" value="{{ $channel->slug }}">
                </div>
            </div>
            <translation-table
                :translations="{{ $translations }}"
                :languages="{{ $languages }}"
                :item="{{ $channel }}"
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
                     'name': ['{{ label('name') }}', 'name'],
                     'slug': ['{{ label('slug') }}', 'slug'],
                     }"
                :item_name="'channel'"
                :text_inputs="[
                    'name',
                    'slug'
                ]"
                :url="'/admin/channel-translations/'" >
            </translation-table>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.channels') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/channels">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
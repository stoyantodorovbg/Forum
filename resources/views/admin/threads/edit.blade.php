@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.threads.update', ['slug' => $thread->slug]) }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_thread') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.threads') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/threads">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('channel') }}</span>
                <span class="info-data">{{ $thread->channel->name }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('published_from') }}</span>
                <span class="info-data">{{ $thread->owner->name }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('created_at') }}</span>
                <span class="info-data">{{ $thread->created_at }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('updated_at') }}</span>
                <span class="info-data">{{ $thread->updated_at }}</span>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title" value="{{ $thread->body }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('body') }}</label>
                <div>
                    <textarea class="form-control" rows="10" id="comment" name="body">{{ $thread->body }}</textarea>
                </div>
            </div>
            <translation-table :translations="{{ $translations }}"
                               :languages="{{ $languages }}"
                               :item="{{ $thread }}"
                               :labels="{
                                    'language': '{{ label('language') }}',
                                    'add_a_translation': '{{ label('add_a_translation') }}',
                                    'language': '{{ label('language') }}',
                                    'body': '{{ label('body') }}',
                                    'save_translation': '{{ label('save_translation') }}',
                                    'edit': '{{ label('edit') }}',
                                    'delete': '{{ label('delete') }}',
                                    }"
                               :text_input_labels="{
                                    'title': ['{{ label('title') }}', 'title'],
                                    }"
                               :textarea_input_labels="{
                                    'body': ['{{ label('body') }}', 'body'],
                                    }"
                               :item_name="'thread'"
                               :text_inputs="['title']"
                               :textarea_inputs="['body']"
                               :url="'/admin/thread-translations/'" >
            </translation-table>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.threads') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/threads">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
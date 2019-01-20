@extends('admin.layouts.app')

@section('content')
    <div class="m-2">
        <a href="{{ route('admin.replies.create') }}">
            <button class="btn btn-success small">{{ label('create_a_reply') }}</button>
        </a>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">{{ label('edit') }}</th>
                <th scope="col">{{ label('status') }}</th>
                <th scope="col">{{ label('body') }}</th>
                <th scope="col">{{ label('thread') }}</th>
                <th scope="col">{{ label('published_from') }}</th>
                <th scope="col">{{ label('created_at') }}</th>
                <th scope="col">{{ label('delete') }}</th>
            </tr>
            <tr>
                <th scope="col"></th>
                <th class="admin-index-search-bool" scope="col admin-search-container" style="vertical-align: top;">
                    <search-bool
                            :name="'replies-status'"
                            :labels="{
                        'search_label': '{{ label('search_status') }}',
                        'first_option': '{{ label('active') }}',
                        'second_option': '{{ label('inactive') }}',
                    }">
                    </search-bool>
                </th>
                <th class="admin-index-search-text" scope="col admin-search-container" style="vertical-align: top;">
                    <search-text :name="'replies-body'"></search-text>
                </th>
                <th class="admin-index-search-text" scope="col admin-search-container" style="vertical-align: top;">
                    <search-text :name="'replies-thread'"></search-text>
                </th>
                <th class="admin-index-search-text" scope="col admin-search-container">
                    <search-text :name="'replies-owner'"></search-text>
                </th>
                <th class="admin-index-search-date" scope="col">
                    <search-date :name="'replies-created_at'"></search-date>
                </th>
                <th scope="col"></th>
            </tr>
        </thead>
        <template>
            <index
                :id_property="'id'"
                :properties="[
                    'body',
                    'thread.title',
                    'owner.name',
                    'created_at'
                ]"
                :model_type="'replies'"
                :search_props="[
                    'replies-status',
                    'replies-body',
                    'replies-thread',
                    'replies-owner',
                    'replies-created_at'
                ]"
                :delitable="1">
            </index>
        </template>
    </table>
@endsection
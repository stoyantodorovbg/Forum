@extends('admin.layouts.app')

@section('content')
    <div class="m-2">
        <a href="{{ route('admin.replies.create') }}">
            <button class="btn btn-success small">Create a Reply</button>
        </a>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">Edit</th>
                <th scope="col">Content</th>
                <th scope="col">Thread</th>
                <th scope="col">Creator</th>
                <th scope="col">Created at</th>
                <th scope="col">Delete</th>
            </tr>
            <tr>
                <th scope="col"></th>
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
                :properties="['body', 'thread.title', 'owner.name', 'created_at']"
                :model_type="'replies'"
                :search_props="['replies-body', 'replies-thread', 'replies-owner', 'replies-created_at']">
            </index>
        </template>
    </table>
@endsection
@extends('admin.layouts.app')

@section('content')
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
                <th scope="col admin-search-container" style="vertical-align: top;">
                    <search-text :name="'replies-body'" style="vertical-align: top;"></search-text>
                </th>
                <th scope="col admin-search-container" style="vertical-align: top;">
                    <search-text :name="'replies-thread'" style="vertical-align: top;"></search-text>
                </th>
                <th scope="col" style="vertical-align: top;">
                    <search-text :name="'replies-owner'"></search-text>
                </th>
                <th scope="col" style="vertical-align: top;">
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
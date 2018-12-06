@extends('admin.layouts.app')

@section('content')
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">Edit</th>
                <th scope="col">Title</th>
                <th scope="col">Thread</th>
                <th scope="col">Creator</th>
                <th scope="col">Created at</th>
                <th scope="col">Delete</th>
            </tr>
            <tr>
                <th scope="col"></th>
                <th scope="col admin-search-container" style="vertical-align: top;">
                    <search-text :name="'replies-title'" style="vertical-align: top;"></search-text>
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
                    :properties="['title', 'thread.title', 'owner.name', 'created_at']"
                    :model_type="'replies'"
                    :search_props="['replies-title', 'replies-thread', 'replies-owner', 'replies-created_at']">
            </index>
        </template>
    </table>
@endsection
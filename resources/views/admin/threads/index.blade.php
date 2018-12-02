@extends('admin.layouts.app')

@section('content')
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">Edit</th>
                <th scope="col">Title</th>
                <th scope="col">Creator</th>
                <th scope="col">Created at</th>
                <th scope="col">Delete</th>
            </tr>
            <tr>
                <th scope="col"></th>
                <th scope="col">
                    <search-text :name="'threads-title'"></search-text>
                </th>
                <th scope="col">
                    <search-text :name="'threads-owner'"></search-text>
                </th>
                <th scope="col">
                </th>
                <th scope="col"></th>
            </tr>
        </thead>
        <template>
            <index
                    :properties="['title', 'owner.name', 'created_at']"
                    :model_type="'threads'"
                    :search_props="['threads-title', 'threads-owner']"></index>
        </template>
    </table>
@endsection
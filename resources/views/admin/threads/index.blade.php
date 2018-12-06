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
                <th scope="col admin-search-container" style="vertical-align: top;">
                    <search-text :name="'threads-title'" style="vertical-align: top;"></search-text>
                </th>
                <th scope="col" style="vertical-align: top;">
                    <search-text :name="'threads-owner'"></search-text>
                </th>
                <th scope="col" style="vertical-align: top;">
                    <search-date :name="'threads-created_at'"></search-date>
                </th>
                <th scope="col"></th>
            </tr>
        </thead>
        <template>
            <index
                :id_property="'slug'"
                :properties="['title', 'owner.name', 'created_at']"
                :model_type="'threads'"
                :search_props="['threads-title', 'threads-owner', 'threads-created_at']">
            </index>
        </template>
    </table>
@endsection
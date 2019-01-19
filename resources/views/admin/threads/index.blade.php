@extends('admin.layouts.app')

@section('content')
    <div class="m-2">
        <a href="{{ route('admin.threads.create') }}">
            <button class="btn btn-success small">{{ label('create_a_thread') }}</button>
        </a>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">{{ label('edit') }}</th>
                <th scope="col">{{ label('status') }}</th>
                <th scope="col">{{ label('title') }}</th>
                <th scope="col">{{ label('published_from') }}</th>
                <th scope="col">{{ label('created_at') }}</th>
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
                :search_props="['threads-title', 'threads-owner', 'threads-created_at']"
                :delitable="1">
            </index>
        </template>
    </table>
@endsection
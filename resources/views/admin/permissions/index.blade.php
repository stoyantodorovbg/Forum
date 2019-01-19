@extends('admin.layouts.app')

@section('content')
    <div class="m-2">
        <a href="{{ route('admin.permissions.create') }}">
            <button class="btn btn-success small">{{ label('create_permission') }}</button>
        </a>
    </div>
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">{{ label('edit') }}</th>
            <th scope="col">{{ label('status') }}</th>
            <th scope="col">{{ label('title') }}</th>
        </tr>
        <tr>
            <th scope="col"></th>
            <th scope="col admin-search-container" style="vertical-align: top;">
                <search-text :name="'permissions-title'" style="vertical-align: top;"></search-text>
            </th>
            </th>

            <th scope="col"></th>
        </tr>
        </thead>
        <template>
            <index
                :id_property="'id'"
                :properties="['title']"
                :model_type="'permissions'"
                :search_props="['permissions-title']"
                :delitable="0">
            </index>
        </template>
    </table>
@endsection
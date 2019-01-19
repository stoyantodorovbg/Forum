@extends('admin.layouts.app')

@section('content')
    <div class="m-2">
        <a href="{{ route('admin.roles.create') }}">
            <button class="btn btn-success small">{{ label('create_role') }}</button>
        </a>
    </div>
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">{{ label('edit') }}</th>
            <th scope="col">{{ label('title') }}</th>
        </tr>
        <tr>
            <th scope="col"></th>
            <th scope="col admin-search-container" style="vertical-align: top;">
                <search-text :name="'roles-title'" style="vertical-align: top;"></search-text>
            </th>
            </th>

            <th scope="col"></th>
        </tr>
        </thead>
        <template>
            <index
                :id_property="'id'"
                :properties="['title']"
                :model_type="'roles'"
                :search_props="['roles-title']"
                :delitable="0">
            </index>
        </template>
    </table>
@endsection
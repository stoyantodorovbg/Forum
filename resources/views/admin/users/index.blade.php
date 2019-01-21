@extends('admin.layouts.app')

@section('content')
    <div class="m-2">
        <a href="{{ route('admin.users.create') }}">
            <button class="btn btn-success small">{{ label('create_user') }}</button>
        </a>
    </div>
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">{{ label('edit') }}</th>
            <th scope="col">{{ label('status') }}</th>
            <th scope="col">{{ label('name') }}</th>
            <th scope="col">{{ label('email') }}</th>
        </tr>
        <tr>
            <th scope="col"></th>
            <th class="admin-index-search-bool" scope="col admin-search-container" style="vertical-align: top;">
                <search-bool
                    :name="'users-status'"
                    :labels="{
                    'search_label': '{{ label('search_status') }}',
                    'first_option': '{{ label('active') }}',
                    'second_option': '{{ label('inactive') }}',
                }">
                </search-bool>
            </th>
            <th scope="col admin-search-container" style="vertical-align: top;">
                <search-text
                    :name="'users-name'"
                    :labels="{
                    'search_label': '{{ label('search_by_name') }}',
                }"></search-text>
            </th>
            <th scope="col admin-search-container" style="vertical-align: top;">
                <search-text
                        :name="'users-email'"
                        :labels="{
                    'search_label': '{{ label('search_by_email') }}',
                }"></search-text>
            </th>
            <th scope="col"></th>
        </tr>
        </thead>
        <template>
            <index
                :id_property="'name'"
                :properties="[
                    'name',
                    'email'
                ]"
                :model_type="'users'"
                :search_props="[
                    'users-status',
                    'users-name',
                    'users-email',
                ]"
                :delitable="0">
            </index>
        </template>
    </table>
@endsection
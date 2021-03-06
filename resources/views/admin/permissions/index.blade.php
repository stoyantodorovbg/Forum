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
                <th scope="col"></th>
                <th class="admin-index-search-bool" scope="col admin-search-container" style="vertical-align: top;">
                    <search-bool
                            :name="'permissions-status'"
                            :labels="{
                            'search_label': '{{ label('search_status') }}',
                            'first_option': '{{ label('active') }}',
                            'second_option': '{{ label('inactive') }}',
                        }">
                    </search-bool>
                </th>
                <th scope="col admin-search-container" style="vertical-align: top;">
                    <search-text
                        :name="'permissions-title'"
                        :labels="{
                                'search_label': '{{ label('search_by_title') }}',
                            }">
                    </search-text>
                </th>
                </th>
                <th scope="col"></th>
            </tr>
            <tr>
                <th scope="col admin-search-container" style="vertical-align: top;">
                    <search-option
                        :name="'permissions-right'"
                        :labels="{
                        'search_label': '{{ label('search_by_right') }}',
                        'all': '{{ label('all') }}',
                        }"
                        :prop_name="'title'"
                        :items="{{ $rights }}">
                    </search-option>
                </th>
            </tr>
            <tr>
                <th scope="col">{{ label('edit') }}</th>
                <th scope="col">{{ label('status') }}</th>
                <th scope="col">{{ label('title') }}</th>
            </tr>
        </thead>
        <template>
            <index
                :id_property="'id'"
                :properties="['title']"
                :model_type="'permissions'"
                :search_props="[
                    'permissions-title',
                    'permissions-status',
                    'permissions-right',
                ]"
                :delitable="0">
            </index>
        </template>
    </table>
@endsection
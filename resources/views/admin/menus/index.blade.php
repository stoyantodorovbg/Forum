@extends('admin.layouts.app')

@section('content')
    <div class="m-2">
        <a href="{{ route('admin.menus.create') }}">
            <button class="btn btn-success small">{{ label('create_a_menu') }}</button>
        </a>
    </div>
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col"></th>
            <th class="admin-index-search-bool" scope="col admin-search-container" style="vertical-align: top;">
                <search-bool
                        :name="'menus-status'"
                        :labels="{
                            'search_label': '{{ label('search_status') }}',
                            'first_option': '{{ label('active') }}',
                            'second_option': '{{ label('inactive') }}',
                        }">
                </search-bool>
            </th>
            <th class="admin-index-search-text" scope="col admin-search-container" style="vertical-align: top;">
                <search-text
                        :name="'menus-title'"
                        :labels="{
                            'search_label': '{{ label('search_by_title') }}',
                        }">
                </search-text>
            </th>
            <th scope="col"></th>
        </tr>
        <tr>
            <th scope="col">{{ label('edit') }}</th>
            <th scope="col">{{ label('status') }}</th>
            <th scope="col">{{ label('title') }}</th>
            <th scope="col">{{ label('description') }}</th>
            <th scope="col">{{ label('delete') }}</th>
        </tr>
        </thead>
        <template>
            <index
                :id_property="'id'"
                :properties="[
                    'title',
                ]"
                :model_type="'menus'"
                :search_props="[
                    'menus-status',
                    'menus-title',
                ]"
                :delitable="1">
            </index>
        </template>
    </table>
@endsection
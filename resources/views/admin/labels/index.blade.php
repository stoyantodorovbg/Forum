@extends('admin.layouts.app')

@section('content')
    <div class="m-2">
        <a href="{{ route('admin.labels.create') }}">
            <button class="btn btn-success small">{{ label('create_a_label') }}</button>
        </a>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col"></th>
                <th class="admin-index-search-bool" scope="col admin-search-container" style="vertical-align: top;">
                    <search-bool
                        :name="'labels-status'"
                        :labels="{
                            'search_label': '{{ label('search_status') }}',
                            'first_option': '{{ label('active') }}',
                            'second_option': '{{ label('inactive') }}',
                        }">
                    </search-bool>
                </th>
                <th class="admin-index-search-text" scope="col admin-search-container" style="vertical-align: top;">
                    <search-text
                        :name="'labels-system_name'"
                        :labels="{
                            'search_label': '{{ label('search_by_system_name') }}',
                        }">
                    </search-text>
                </th>
                <th class="admin-index-search-text" scope="col admin-search-container" style="vertical-align: top;">
                    <search-text
                        :name="'labels-default_content'"
                        :labels="{
                                'search_label': '{{ label('search_by_default_content') }}',
                            }">
                    </search-text>
                </th>
                <th scope="col"></th>
            </tr>
            <tr>
                <th scope="col">{{ label('edit') }}</th>
                <th scope="col">{{ label('status') }}</th>
                <th scope="col">{{ label('system_name') }}</th>
                <th scope="col">{{ label('body') }}</th>
                <th scope="col">{{ label('delete') }}</th>
            </tr>
        </thead>
        <template>
            <index
                :id_property="'id'"
                :properties="[
                    'system_name',
                    'default_content'
                ]"
                :model_type="'labels'"
                :search_props="[
                    'labels-status',
                    'labels-system_name',
                    'labels-default_content'
                ]"
                :delitable="1">
            </index>
        </template>
    </table>
@endsection
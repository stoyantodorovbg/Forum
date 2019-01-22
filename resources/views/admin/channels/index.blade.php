@extends('admin.layouts.app')

@section('content')
    <div class="m-2">
        <a href="{{ route('admin.channels.create') }}">
            <button class="btn btn-success small">{{ label('create_channel') }}</button>
        </a>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col"></th>
                <th class="admin-index-search-bool" scope="col admin-search-container" style="vertical-align: top;">
                    <search-bool
                        :name="'channels-status'"
                        :labels="{
                            'search_label': '{{ label('search_status') }}',
                            'first_option': '{{ label('active') }}',
                            'second_option': '{{ label('inactive') }}',
                        }">
                    </search-bool>
                </th>
                <th scope="col admin-search-container" style="vertical-align: top;">
                    <search-text
                        :name="'channels-name'"
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
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <template>
            <index
                :id_property="'slug'"
                :properties="['name']"
                :model_type="'channels'"
                :search_props="[
                    'channels-status',
                    'channels-name',
                ]"
                :delitable="1">
            </index>
        </template>
    </table>
@endsection
@extends('admin.layouts.app')

@section('content')
    <div class="m-2">
        <a href="{{ route('admin.languages.create') }}">
            <button class="btn btn-success small">{{ label('create_language') }}</button>
        </a>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col"></th>
                <th class="admin-index-search-bool" scope="col admin-search-container" style="vertical-align: top;">
                    <search-bool
                            :name="'languages-status'"
                            :labels="{
                            'search_label': '{{ label('search_status') }}',
                            'first_option': '{{ label('active') }}',
                            'second_option': '{{ label('inactive') }}',
                        }">
                    </search-bool>
                </th>
                <th scope="col admin-search-container" style="vertical-align: top;">
                    <search-text
                            :name="'languages-title'"
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
            </tr>
        </thead>
        <template>
            <index
                :id_property="'id'"
                :properties="['title']"
                :model_type="'languages'"
                :search_props="[
                    'languages-status',
                    'languages-title',
                    'languages-short_title',
                ]"
                :delitable="0">
            </index>
        </template>
    </table>
@endsection
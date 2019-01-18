@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.roles.store') }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('create_role') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.roles') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/roles">{{ label('save_exit') }}</button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title">
                </div>
            </div>
            <label class="col-form-label">{{ label('permissions') }}</label>
            <related-items-input
                    :all_items="{{ $allPermissions }}"
                    :related_items="[]"
                    :url="'/admin/roles-permissions/'"
                    :item_id="'-1'"
                    :input_name="'permissions'"
                    :labels="{
                        'add_item': '{{ label('add_permission') }}',
                        'choose_one': '{{ label('choose_one') }}',
                        'role_without_permissions': '{{ label('role_without_permissions') }}'
                        }">
            </related-items-input>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.roles') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/roles">{{ label('save_exit') }}</button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
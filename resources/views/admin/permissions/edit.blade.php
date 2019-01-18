@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.permissions.update', ['id' => $permission->id]) }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_permission') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.permissions') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit"
                            value="/admin/permissions">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('created_at') }} </span>
                <span class="info-data">{{ $permission->created_at }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('updated_at') }} </span>
                <span class="info-data">{{ $permission->updated_at }}</span>
            </div>
            <label class="col-form-label">{{ label('rights') }}</label>
            <related-items-input
                    :all_items="{{ $allRights }}"
                    :related_items="{{ $permissionRights }}"
                    :url="'/admin/permissions-rights/'"
                    :item_id="{{ $permission->id }}"
                    :input_name="'rights'"
                    :labels="{
                        'add_item': '{{ label('add_permission') }}',
                        'choose_one': '{{ label('choose_one') }}',
                        'role_without_permissions': '{{ label('permission_without_rights') }}'
                        }">
            </related-items-input>
            <div class="form-group">
                <label class="col-form-item">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title" value="{{ $permission->title }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-item">{{ label('description') }}</label>
                <div>
                    <input class="form-control" name="description" value="{{ $permission->description }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-item">{{ label('system_name') }}</label>
                <div>
                    <input class="form-control" name="system_name" value="{{ $permission->system_name }}">
                </div>
            </div>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.permissions') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/permissions">{{ label('save_exit') }}</button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
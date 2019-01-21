@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.roles.update', ['id' => $role->id]) }}">
        {{ csrf_field() }}
        < class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_role') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.roles') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/roles">{{ label('save_exit') }}</button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('created_at') }} </span>
                <span class="info-data">{{ $role->created_at }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('updated_at') }} </span>
                <span class="info-data">{{ $role->updated_at }}</span>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('status') }}</label>
                <select class="form-control" name="status">
                    <option {{ $role->status ? 'selected' : '' }} value="1">
                        {{ label('active') }}
                    </option>
                    <option {{ !$role->status ? 'selected' : '' }} value="0">
                        {{ label('inactive') }}
                    </option>
                </select>
            </div>
            <related-items-input
                :all_items="{{ $allPermissions }}"
                :related_items="{{ $rolePermissions }}"
                :url="'/admin/roles-permissions/'"
                :item_id="{{ $role->id }}"
                :input_name="'permissions'"
                :labels="{
                    'add_item': '{{ label('add_permission') }}',
                    'choose_one': '{{ label('choose_one') }}',
                    'role_without_permissions': '{{ label('role_without_permissions') }}',
                    'related_models': '{{ label('permissions') }}',
                }">
            </related-items-input>
            <div class="form-group">
                <label class="col-form-item">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title" value="{{ $role->title }}" type="text">
                </div>
            </div>
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
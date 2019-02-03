@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.permissions.update', ['id' => $permission->id]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_permission') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.permissions') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" name="exit" value="true">
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
            <div class="form-group">
                <label class="col-form-label">{{ label('status') }}</label>
                <select class="form-control" name="status">
                    <option {{ $permission->status ? 'selected' : '' }} value="1">
                        {{ label('active') }}
                    </option>
                    <option {{ !$permission->status ? 'selected' : '' }} value="0">
                        {{ label('inactive') }}
                    </option>
                </select>
            </div>
            <related-items-input
                :all_items="{{ $allRights }}"
                :related_items="{{ $permissionRights }}"
                :url="'/admin/permissions-rights/'"
                :item_id="{{ $permission->id }}"
                :input_name="'rights'"
                :labels="{
                    'add_item': '{{ label('add_permission') }}',
                    'choose_one': '{{ label('choose_one') }}',
                    'role_without_permissions': '{{ label('permission_without_rights') }}',
                    'related_models': '{{ label('rights') }}',
                }">
            </related-items-input>
            <div class="form-group">
                <label class="col-form-item">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title" value="{{ $permission->title }}" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-item">{{ label('description') }}</label>
                <div>
                    <input class="form-control" name="description" value="{{ $permission->description }}" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-item">{{ label('system_name') }}</label>
                <div>
                    <input class="form-control" name="system_name" value="{{ $permission->system_name }}" type="text">
                </div>
            </div>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.permissions') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" name="exit" value="true">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
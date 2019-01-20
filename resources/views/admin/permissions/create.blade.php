@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.permissions.store') }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('create_permission') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.permissions') }}">
                        <button class="btn btn-info" type="button">
                            {{ label('exit_without_saving') }}
                        </button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/permissions">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('status') }}</label>
                <select class="form-control" name="status">
                    <option value="0">
                        {{ label('inactive') }}
                    </option>
                    <option value="1">
                        {{ label('active') }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('description') }}</label>
                <div>
                    <input class="form-control" name="description">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('system_name') }}</label>
                <div>
                    <input class="form-control" name="system_name">
                </div>
            </div>
            <label class="col-form-label">{{ label('rights') }}</label>
            <related-items-input
                    :all_items="{{ $allRights }}"
                    :related_items="[]"
                    :url="'/admin/permissions-rights/'"
                    :item_id="'-1'"
                    :input_name="'rights'"
                    :labels="{
                        'add_item': '{{ label('add_right') }}',
                        'choose_one': '{{ label('choose_one') }}',
                        'role_without_permissions': '{{ label('permission_without_rights') }}'
                        }">
            </related-items-input>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.permissions') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/permissions">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
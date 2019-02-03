@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.users.update', ['name' => $user->name]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_user') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.users') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" name="exit" value="true">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('name') }} </span>
                <span class="info-data">{{ $user->name }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('email') }} </span>
                <span class="info-data">{{ $user->email }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('created_at') }} </span>
                <span class="info-data">{{ $user->created_at }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">{{ label('updated_at') }} </span>
                <span class="info-data">{{ $user->updated_at }}</span>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('status') }}</label>
                <select class="form-control" name="status">
                    <option {{ $user->status ? 'selected' : '' }} value="1">
                        {{ label('active') }}
                    </option>
                    <option {{ !$user->status ? 'selected' : '' }} value="0">
                        {{ label('inactive') }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('mail_confirmation') }}</label>
                <select class="form-control" name="confirmed">
                    <option {{ $user->confirmed ? 'selected' : '' }} value="1">
                        {{ label('confirmed') }}
                    </option>
                    <option {{ !$user->confirmed ? 'selected' : '' }} value="0">
                        {{ label('not_confirmed') }}
                    </option>
                </select>
            </div>
            <related-items-input
                :all_items="{{ $allRoles }}"
                :related_items="{{ $userRoles }}"
                :url="'/admin/roles-permissions/'"
                :item_id="{{ $user->id }}"
                :input_name="'roles'"
                :labels="{
                'add_item': '{{ label('add_role') }}',
                'choose_one': '{{ label('choose_one') }}',
                'role_without_permissions': '{{ label('user_without_roles') }}',
                'related_models': '{{ label('roles') }}',
            }">
            </related-items-input>
            <related-items-input
                :all_items="{{ $allPermissions }}"
                :related_items="{{ $userPermissions }}"
                :url="'/admin/roles-permissions/'"
                :item_id="{{ $user->id }}"
                :input_name="'permissions'"
                :labels="{
                'add_item': '{{ label('add_permission') }}',
                'choose_one': '{{ label('choose_one') }}',
                'role_without_permissions': '{{ label('user_without_permissions') }}',
                'related_models': '{{ label('permissions') }}',
            }">
            </related-items-input>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.users') }}">
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
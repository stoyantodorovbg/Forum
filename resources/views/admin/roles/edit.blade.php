@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.roles.update', ['id' => $role->id]) }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_reply') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.replies') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/replies">{{ label('save_exit') }}</button>
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
            <label class="col-form-label">{{ label('permissions') }}</label>
            @foreach($rolePermissions as $permission)
                <div class="element-row">
                    <span class="info-edit-item">{{ $permission->title }}</span>
                    <span class="delete-item">&times;</span>
                </div>
            @endforeach
            <div class="form-group">
                <label class="col-form-item">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title" value="{{ $role->title }}">
                </div>
            </div>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.replies') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/replies">{{ label('save_exit') }}</button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.users.store') }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('create_user') }}
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
                <label class="col-form-label">{{ label('mail_confirmation') }}</label>
                <select class="form-control" name="confirmed">
                    <option value="0">
                        {{ label('not_confirmed') }}
                    </option>
                    <option value="1">
                        {{ label('confirmed') }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('name') }}</label>
                <div>
                    <input class="form-control" name="name" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('email') }}</label>
                <div>
                    <input class="form-control" name="email" type="email">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('password') }}</label>
                <div>
                    <input class="form-control" name="password" type="password">
                </div>
            </div>
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
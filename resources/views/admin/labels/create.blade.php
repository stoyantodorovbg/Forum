@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.labels.store') }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('create_a_label') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.labels') }}">
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
                <label class="col-form-label">{{ label('system_name') }}</label>
                <div>
                    <input class="form-control" name="system_name" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('body') }}</label>
                <div>
                    <input class="form-control" name="default_content" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('default_label_language') }}</label>
                <select class="form-control" name="default_language_id">
                    @foreach($languages as $language)
                        <option value="{{ $language->id }}">
                            {{ ucfirst($language->title) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.labels') }}">
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
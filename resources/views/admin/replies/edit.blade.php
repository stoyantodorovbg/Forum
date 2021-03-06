@extends('admin.layouts.app')

@section('content')

<form method="POST" action="{{ route('admin.replies.update', ['id' => $reply->id]) }}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="container-admin-form col-sm-11">
        <div class="admin-form-header">
            <h1>
                {{ label('edit_reply') }}
            </h1>
            <div class="admin-form-buttons">
                <a href="{{ route('admin.replies') }}">
                    <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                </a>
                <button class="btn btn-danger saveAndExit" name="exit" value="true">
                    {{ label('save_exit') }}
                </button>
                <button class="btn btn-danger">{{ label('save') }}</button>
            </div>
        </div>
        <div class="info-model">
            <span class="info-label">{{ label('thread') }} </span>
            <span class="info-data">{{ $reply->thread->title }}</span>
        </div>
        <div class="info-model">
            <span class="info-label">{{ label('published_from') }} </span>
            <span class="info-data">{{ $reply->owner->name }}</span>
        </div>
        <div class="info-model">
            <span class="info-label">{{ label('created_at') }} </span>
            <span class="info-data">{{ $reply->created_at }}</span>
        </div>
        <div class="info-model">
            <span class="info-label">{{ label('updated_at') }} </span>
            <span class="info-data">{{ $reply->updated_at }}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">{{ label('status') }}</label>
            <select class="form-control" name="status">
                <option {{ $reply->status ? 'selected' : '' }} value="1">
                    {{ label('active') }}
                </option>
                <option {{ !$reply->status ? 'selected' : '' }} value="0">
                    {{ label('inactive') }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label class="col-form-label">{{ label('body') }}</label>
            <div>
                <textarea class="form-control" rows="10" id="comment" name="body">{{ $reply->body }}</textarea>
            </div>
        </div>
        <div class="admin-form-footer">
            <div class="admin-form-buttons">
                <a href="{{ route('admin.replies') }}">
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
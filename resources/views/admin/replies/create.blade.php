@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{ route('admin.replies.store') }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>{{ label('create_a_reply') }}</h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.replies') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/replies">
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
                <label class="col-form-label">{{ label('thread') }}</label>
                <div>
                    <select class="form-control" name="thread_id">
                        <option selected value="">{{ label('select_a_thread') }}</option>
                        @foreach($threads as $thread)
                            <option value="{{ $thread->id }}">{{ $thread->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('published_from') }} </label>
                <div>
                    <select class="form-control" name="user_id">
                        <option selected value="{{ auth()->id() }}">{{ auth()->user()->name }}</option>
                        @foreach($users as $user)
                            @if($user->id != auth()->id())
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('body') }}</label>
                <div>
                    <textarea class="form-control" rows="10" name="body"></textarea>
                </div>
            </div>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.replies') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/replies">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
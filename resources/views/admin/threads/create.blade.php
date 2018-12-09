@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{ route('admin.threads.store') }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>{{ label('create_a_thread') }}</h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.threads') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/threads">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('channel') }}</label>
                <div>
                    <select class="form-control" name="channel_id">
                        <option selected value="">{{ label('select_channel') }}</option>
                        @foreach($channels as $channel)
                            <option value="{{ $channel->id }}">{{ $channel->name }}</option>
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
                <label class="col-form-label">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title">
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
                    <a href="{{ route('admin.threads') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/threads">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{ route('admin.replies.store') }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    Create a Reply
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.replies') }}">
                        <button class="btn btn-info" type="button">Exit without Saving</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/replies">
                        Save and Exit
                    </button>
                    <button class="btn btn-danger">Save</button>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">Thread: </label>
                <div>
                    <select class="form-control" name="thread_id">
                        <option selected value="">Select a Thread</option>
                        @foreach($threads as $thread)
                            <option value="{{ $thread->id }}">{{ $thread->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">User: </label>
                <div>
                    <select class="form-control" name="user_id">
                        <option selected value="{{ auth()->id() }}">{{ auth()->user()->name }}</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">Body</label>
                <div>
                    <textarea class="form-control" rows="10" name="body"></textarea>
                </div>
            </div>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.replies') }}">
                        <button class="btn btn-info" type="button">Exit without Saving</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/replies">
                        Save and Exit
                    </button>
                    <button class="btn btn-danger">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
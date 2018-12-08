@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.threads.update', ['slug' => $thread->slug]) }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    Edit {{ class_basename($thread) }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.threads') }}">
                        <button class="btn btn-info" type="button">Exit without Saving</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/threads">
                        Save and Exit
                    </button>
                    <button class="btn btn-danger">Save</button>
                </div>
            </div>
            <div class="info-model">
                <span class="info-label">Channel: </span>
                <span class="info-data">{{ $thread->channel->name }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">User: </span>
                <span class="info-data">{{ $thread->owner->name }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">Created at: </span>
                <span class="info-data">{{ $thread->created_at }}</span>
            </div>
            <div class="info-model">
                <span class="info-label">Updated at: </span>
                <span class="info-data">{{ $thread->updated_at }}</span>
            </div>
            <div class="form-group">
                <label class="col-form-label">Title</label>
                <div>
                    <input class="form-control" name="title" value="{{ $thread->body }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">Body</label>
                <div>
                    <textarea class="form-control" rows="10" id="comment" name="body">{{ $thread->body }}</textarea>
                </div>
            </div>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.replies') }}">
                        <button class="btn btn-info" type="button">Exit without Saving</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/threads">
                        Save and Exit
                    </button>
                    <button class="btn btn-danger">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
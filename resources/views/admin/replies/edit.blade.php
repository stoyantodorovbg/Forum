@extends('admin.layouts.app')

@section('content')

<form method="POST" action="{{ route('admin.replies.update', ['id' => $reply->id]) }}">
    {{ csrf_field() }}
    <div class="container-admin-form col-sm-11">
        <div class="admin-form-header">
            <h1>
                Edit {{ class_basename($reply) }}
            </h1>
            <div class="admin-form-buttons">
                <a href="{{ route('admin.replies') }}">
                    <button class="btn btn-info" type="button">Exit without Saving</button>
                </a>
                <button class="btn btn-danger saveAndExit" value="/admin/replies/redirectIndex">
                    Save and Exit
                </button>
                <button class="btn btn-danger">Save</button>
            </div>
        </div>
        <div class="info-model">
            <span class="info-label">User: </span>
            <span class="info-data">{{ $reply->owner->name }}</span>
        </div>
        <div class="info-model">
            <span class="info-label">Thread: </span>
            <span class="info-data">{{ $reply->thread->title }}</span>
        </div>
        <div class="info-model">
            <span class="info-label">Created at: </span>
            <span class="info-data">{{ $reply->created_at }}</span>
        </div>
        <div class="info-model">
            <span class="info-label">Updated at: </span>
            <span class="info-data">{{ $reply->updated_at }}</span>
        </div>
        <div class="form-group">
            <label class="col-form-label">Body</label>
            <div>
                <textarea class="form-control" rows="10" id="comment" name="body">{{ $reply->body }}</textarea>
            </div>
        </div>
        <div class="admin-form-footer">
            <div class="admin-form-buttons">
                <a href="{{ route('admin.replies') }}">
                    <button class="btn btn-info" type="button">Exit without Saving</button>
                </a>
                <button class="btn btn-danger saveAndExit" value="/admin/replies/redirectIndex">
                    Save and Exit
                </button>
                <button class="btn btn-danger">Save</button>
            </div>
        </div>
    </div>
</form>
@endsection
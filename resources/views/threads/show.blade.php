@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="#">
                            {{ $thread->owner->name }} posted:
                        </a>
                        {{ $thread->title }}
                    </div>
                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Replies</div>
                    @foreach($thread->replies as $reply)
                        <div class="card-body">
                            @include('threads.reply')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if (auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <form method="POST" action="{{ $thread->path(). '/replies' }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea
                                        class="form-control"
                                        name="body"
                                        id="body"
                                        placeholder="Have you something to say?"
                                        rows="5"
                                        required>
                                    {{ old('body') }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <button
                                        class="btn btn-default"
                                        type="submit">
                                    Post
                                </button>
                            </div>

                            @if(count($errors))
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center">
                If you want to participate in this discussion, please, sign in:
                <a href="{{ route('login') }}">Login</a>
            </p>
        @endif
    </div>
@endsection

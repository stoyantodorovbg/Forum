@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <h1 class="panel-heading">
                        <a href="#">
                            {{ $thread->owner->name }} posted:
                        </a>
                        {{ $thread->title }}
                    </h1>
                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>

        @if (auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form method="POST" action="{{ $thread->path(). '/replies' }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea
                                    class="form-control"
                                    name="body"
                                    id="body"
                                    placeholder="Have you something to say?"
                                    rows="5"
                            ></textarea>
                        </div>
                        <button
                                class="btn btn-default"
                                type="submit"
                        >Post</button>
                    </form>
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

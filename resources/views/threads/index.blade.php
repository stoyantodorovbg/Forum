@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forum threads</div>
                    <div class="card-body">
                        @foreach( $threads as $thread)
                            <article>
                                <h4>
                                    <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                                </h4>
                                <p>
                                    {{ $thread->body }}
                                </p>
                                <p>
                                    {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}
                                </p>
                                <br>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

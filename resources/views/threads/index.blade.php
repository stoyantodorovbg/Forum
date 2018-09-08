@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">
                    <h1>
                        FORUM THREADS
                    </h1>
                </div>
                @forelse( $threads as $thread)
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                <a href="{{ $thread->path() }}">
                                    @if($thread->hasUpdatesFor())
                                        <strong>
                                            {{ $thread->title }}
                                        </strong>
                                    @else
                                        {{ $thread->title }}
                                    @endif
                                </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <article>
                                <p>
                                    {{ $thread->body }}
                                </p>
                                <p>
                                    {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}
                                </p>
                                <br>
                            </article>
                        </div>
                    </div>
                @empty
                    <p>There are no relevant results at this time.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

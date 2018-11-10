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
                @include('threads._list')

                {{ $threads->render() }}
            </div>
            <div class="col-md-4">
                @if(count($trending))
                    <div class="panel-heading default">
                        <div class="card">
                            <div class="card-heading p-4">
                                <h4 class>Trending Threads</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach($trending as $thread)
                                        <li class="list-group-item">
                                            <a href="{{ url($thread->path) }}">{{ $thread->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header m-2">
                    <h1>
                        {{ label('forum_threads') }}
                    </h1>
                </div>
                @include('threads._list')

                {{ $threads->render() }}
            </div>
            <div class="col-md-4">
                <div class="panel-heading default">
                    <div class="card">
                        <div class="card-heading p-4">
                            <h4 class>Search</h4>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="/threads/search">
                                <div class="form-group">
                                    <input type="text" placeholder="{{ label('enter_search_criterion') }}" name="q" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">{{ label('search') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if(count($trending))
                    <div class="panel-heading default">
                        <div class="card">
                            <div class="card-heading p-4">
                                <h4 class>{{ label('trending_threads') }}</h4>
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

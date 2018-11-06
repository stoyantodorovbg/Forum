@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/vendor/jquery.atwho.css') }}" rel="stylesheet">
@endsection

@section('content')
    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <img src="/storage/{{ $thread->owner->avatar() }}"
                                 calss="mr-1"
                                 width="70" height="70"
                                 alt="{{ $thread->owner->name }}">
                            <a href="{{ route('profile', $thread->owner->name) }}">
                                {{ $thread->owner->name }} posted:
                            </a>
                            {{ $thread->title }}
                            <p>
                                Before {{ $thread->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="card-body">
                            {{ $thread->body }}
                        </div>

                        @can('update', $thread)
                            <form action="{{ $thread->path() }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <div class="form-group">
                                    <button
                                            class="btn btn-danger"
                                            type="submit">
                                        Delete
                                    </button>
                                </div>
                            </form>
                        @endcan
                    </div>
                    <replies @added="repliesCount++"
                             @removed="repliesCount--">
                    </replies>

                    {{--<div class="card">--}}
                        {{--<div class="card-header">Replies</div>--}}
                        {{--@foreach($replies as $reply)--}}
                            {{--<div class="card-body">--}}
                                {{--@include('threads.reply')--}}
                            {{--</div>--}}
                        {{--@endforeach--}}

                        {{--{{ $replies->links() }}--}}
                    {{--</div>--}}
                    @if(count($errors))
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>
                                Published on {{ $thread->created_at->diffForHumans() }}
                            </p>
                            <p>
                                <a href="#">
                                    By {{ $thread->owner->name }}
                                </a>
                            </p>
                            <p>
                                <a href="#">
                                    {{ str_plural('Comment', $thread->replies_count) }}:  <span v-text="repliesCount"></span>
                                </a>
                            </p>
                            <p>
                                <subscribe-button :active="{{ json_encode($thread->isUserSubscribedTo) }}"></subscribe-button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </thread-view>
@endsection

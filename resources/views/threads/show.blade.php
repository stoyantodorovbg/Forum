@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/vendor/jquery.atwho.css') }}" rel="stylesheet">
@endsection

@section('content')
    <thread-view :thread="{{ $thread}}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @include('threads._question')
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
                                <subscribe-button :active="{{ json_encode($thread->isUserSubscribedTo) }}" v-if="signedIn"></subscribe-button>
                                <button
                                        class="btn btn-default mr-2"
                                        v-if="authorize('isAdmin')"
                                        v-text="locked ? 'Unlock' : 'Lock'"
                                        @click="toggleLock">
                                    Lock
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </thread-view>
@endsection

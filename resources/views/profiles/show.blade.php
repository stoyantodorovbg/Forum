@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <h2>
                        {{ $profileUser->name }}
                        <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h2>
                </div>
            </div>
        </div>

        @foreach($threads as $thread )
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
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
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $threads->links() }}

@endsection


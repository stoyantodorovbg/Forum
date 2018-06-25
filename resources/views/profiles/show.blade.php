@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h2>
                {{ $profileUser->name }}
                <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h2>
        </div>
    </div>

    @foreach($threads as $thread )
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
    @endforeach

    {{ $threads->links() }}

@endsection


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

        @forelse($activities as $date => $activity )
            <h3 class="page-header">
                {{ $date }}
            </h3>
            @foreach ($activity as $record)
                <div class="row">
                    @if (view()->exists("profiles.activities.$record->type"))
                        @include("profiles.activities.$record->type", ['activity' => $record])
                    @endif
                </div>
            @endforeach
        @empty
            <p>
                There is no activity for this user yet.
            </p>
        @endforelse
    </div>

    {{--{{ $activity->links() }}--}}

@endsection


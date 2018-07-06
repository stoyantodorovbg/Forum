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

        @foreach($activities as $date => $activity )
            <h3 class="page-header">
                {{ $date }}
            </h3>
            @foreach ($activity as $record)
                <div class="row">
                    @include("profiles.activities.$record->type", ['activity' => $record])
                </div>
            @endforeach
        @endforeach
    </div>

    {{--{{ $activity->links() }}--}}

@endsection


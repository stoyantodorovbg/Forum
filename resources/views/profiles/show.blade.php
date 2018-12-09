@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <avatar-form :user="{{ $profileUser }}"></avatar-form>
                </div>
            </div>
        </div>

        @forelse($activities as $date => $activity )
            <h3 class="page-header">
                {{ $date }}
            </h3>
            @foreach ($activity as $record)
                {{--<div class="row">--}}
                    @if (view()->exists("profiles.activities.$record->type"))
                        @include("profiles.activities.$record->type", ['activity' => $record])
                    @endif
                {{--</div>--}}
            @endforeach
        @empty
            <p>{{ label('no_activities_for_this_user') }}</p>
        @endforelse
    </div>

    {{--{{ $activity->links() }}--}}

@endsection


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h2>
                        {{ $profileUser->name }}
                        <small>since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h2>

                    @can('update', $profileUser)
                        <form method="POST"
                              action="{{ route('avatar_path', $profileUser) }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <input type="file" name="avatar_path">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    @endcan

                    <img src="/storage/{{ $profileUser->avatar() }}"
                         alt="{{ $profileUser->name }}"
                         width="200" height="200">
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
            <p>
                There is no activity for this user yet.
            </p>
        @endforelse
    </div>

    {{--{{ $activity->links() }}--}}

@endsection


@component('profiles.activities.activity')
    @slot('heading')
        {{ $profileUser->name }} favorited a reply to this
        <a href="{{ $activity->subject->favorite->path() }}">
            thread
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->favorite->body }}
    @endslot
@endcomponent

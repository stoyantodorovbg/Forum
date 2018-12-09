@component('profiles.activities.activity')
    @slot('heading')
        {{ $profileUser->name }} {{ label('favorited_a_reply_to_this') }}
        <a href="{{ $activity->subject->favorite->path() }}">
            thread
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->favorite->body }}
    @endslot
@endcomponent

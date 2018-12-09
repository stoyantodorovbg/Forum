@component('profiles.activities.activity')
    @slot('heading')
        {{ $profileUser->name }} {{ label('replied_to_a') }}
        <a href="{{ $activity->subject->thread->path() }}">
            {{ $activity->subject->thread->title }}
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->thread->body }}
    @endslot
@endcomponent
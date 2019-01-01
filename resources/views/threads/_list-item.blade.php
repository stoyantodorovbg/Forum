<div class="panel-heading default m-2">
    <div class="card">
        <div class="card-header">
            <h4>
                <a href="{{ $thread->path() }}">
                    @if(auth()->check() && $thread->hasUpdatesFor())
                    <strong>
                        {{ translateProp('Thread', $thread->id, 'title') }}
                    </strong>
                    @else
                        {{ translateProp('Thread', $thread->id, 'title') }}
                    @endif
                </a>
            </h4>
            <h5>
                {{ label('posted_by') }} <a href="{{ route('profile', $thread->owner->name) }}">{{ $thread->owner->name }}</a>
            </h5>
        </div>
        <div class="card-body">
            <article>
                <p>
                    {!! translateProp('Thread', $thread->id, 'body') !!}
                    {!! $thread->body !!}
                </p>
                <p>
                    {{ $thread->replies_count }} {{ $thread->replies_count > 1 ? label('comment') : label('comments')}}
                </p>
                <br>
            </article>
        </div>
        <div class="card-footer">
            {{ $thread->visits()->count() }} {{ $thread->visits()->count() > 1 ? label('visit') : label('visits')}}
        </div>
    </div>
</div>
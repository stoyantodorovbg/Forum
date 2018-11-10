<div class="panel-heading default m-2">
    <div class="card">
        <div class="card-header">
            <h4>
                <a href="{{ $thread->path() }}">
                    @if(auth()->check() && $thread->hasUpdatesFor())
                    <strong>
                        {{ $thread->title }}
                    </strong>
                    @else
                    {{ $thread->title }}
                    @endif
                </a>
            </h4>
            <h5>
                Posted by <a href="{{ route('profile', $thread->owner->name) }}">{{ $thread->owner->name }}</a>
            </h5>
        </div>
        <div class="card-body">
            <article>
                <p>
                    {{ $thread->body }}
                </p>
                <p>
                    {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}
                </p>
                <br>
            </article>
        </div>
        <div class="card-footer">
            {{ $thread->visits() }} Visits
        </div>
    </div>
</div>
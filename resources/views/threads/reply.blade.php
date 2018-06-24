<div class="panel panel-default">
    <div class="panel-heading">
        <a href="#">
            {{ $reply->owner->name }}
        </a>
        said:
    </div>
    <div class="panel-body">
        <p>
            {{ $reply->body }}
        </p>
        <p>
            {{ $reply->created_at->diffForHumans() }}
        </p>
        <p>
        Likes: {{ $reply->favorites()->count() }}
        </p>
        <div>
            <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                    Like
                </button>
            </form>
        </div>
    </div>
</div>

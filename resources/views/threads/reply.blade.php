<div class="panel panel-default">
    <h3 class="panel-heading">
        <a href="#">
            {{ $reply->owner->name }}
        </a>
        said:
    </h3>
    <div class="panel-body">
        <p>
            {{ $reply->body }}
        </p>
        <p>
            {{ $reply->created_at->diffForHumans() }}
        </p>
    </div>
</div>

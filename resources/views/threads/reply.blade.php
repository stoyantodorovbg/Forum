<div class="panel panel-default">
    <h3 class="panel-heading">
        {{ $reply->created_at->diffForHumans() }}
        <a href="#">
            {{ $reply->owner->name }}
        </a>
        said:
    </h3>
    <div class="panel-body">
        {{ $reply->body }}
    </div>
</div>

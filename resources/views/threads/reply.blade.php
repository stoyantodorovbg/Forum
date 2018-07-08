<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ route('profile', $reply->owner->name) }}">
                {{ $reply->owner->name }}
            </a>
            said:
                <div v-if="editing">
                        <div class="form-group">
                            <textarea class="form-control" v-model="body"></textarea>
                            <button class="btn xs btn-primary" @click="update">Update</button>
                            <button class="btn xs btn-link" @click="editing=false">Cancel</button>
                        </div>
                    </div>
            <div v-else v-text="body"></div>
        </div>
        <div class="panel-body">
            <p>
                {{ $reply->created_at->diffForHumans() }}
            </p>
            <p>
                {{ $reply->favorites()->count() }} {{ str_plural('Like', $reply->favorites_count) }}
            </p>
        </div>
        <br>
        <div class="panel-footer level">
            @can('update', $reply)
                <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-default mr-1" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        Like
                    </button>
                </form>
                <button class="btn btn-xs mr-1" @click="editing = true">Edit</button>
                <form method="POST" action="/replies/{{ $reply->id }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-xs">
                        Delete
                    </button>
                </form>
            @endcan
        </div>
    </div>
</reply>

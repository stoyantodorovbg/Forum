<div class="card" v-if="!editing">
    <div class="card-header">
        <img src="/storage/{{ $thread->owner->avatar_path }}"
             class="mr-1"
             width="70" height="70"
             alt="{{ $thread->owner->name }}">
        <a href="{{ route('profile', $thread->owner->name) }}">
            {{ $thread->owner->name }} posted:
        </a>
        <p v-text="form.title"></p>

        <p>
            Before {{ $thread->created_at->diffForHumans() }}
        </p>
    </div>

    <div class="card-body">
        <img class="thread-image" src="/storage/{{ $thread->image }}" alt="{{ $thread->title }}">
        <p v-html="form.body"></p>
    </div>

    <div class="card-footer" v-if="authorize('owns', thread)">
        <form action="{{ $thread->path() }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button class="btn btn-danger thread-delete" type="submit">
                Delete
            </button>
        </form>
        <button class="btn btn-xs" @click="editing = true">Edit</button>
    </div>
</div>

<div class="card"  v-else>
    <div class="card-header">
        <img src="/storage/{{ $thread->owner->avatar_path }}"
             calss="mr-1"
             width="70" height="70"
             alt="{{ $thread->owner->name }}">
        <a href="{{ route('profile', $thread->owner->name) }}">
            {{ $thread->owner->name }} posted:
        </a>
        <p>
            Before {{ $thread->created_at->diffForHumans() }}
        </p>
    </div>

    <div class="card-body">
        <label for="channel_id">Choose a channel</label>
        <select class="form-control"
                v-model="form.channel_id"
                id="channel_id"
                required>
            <option value="">
                Choose one
            </option>
            @foreach($channels as $channel)
                <option value="{{ $channel->id }}" @if(isset($thread)) {{ $thread->channel_id == $channel->id ? "selected" : "" }} @else {{ old('channel_id') == $channel->id ? "selected" : "" }} @endif >
                    {{ $channel->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="card-body">
        <input class="form-control" type="text" v-model="form.title">
    </div>
    <div class="card-body">
        <wysiwyg rows=10 v-model="form.body" :value="form.body"></wysiwyg>
    </div>

    <div class="card-footer">
        <div class="form-footer">
            <button class="btn btn-xs btn-primary" @click="update">Save</button>
            <button class="btn btn-xs" @click="cancel">Cancel</button>
        </div>
    </div>
</div>
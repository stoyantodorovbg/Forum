{{--<form class="form-horizontal" role="form">--}}
<div class="form-group">
    <label for="channel_id">Choose a channel</label>
    <select class="form-control"
            name="channel_id"
            id="channel_id"
            value="{{ isset($thread) ? $thread->channel_id : old('channel_id') }}"
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

<div class="form-group">
    <label for="title">Title</label>
    <input class="form-control"
           type="text"
           name="title"
           id="title"
           value="{{ isset($thread) ? $thread->title : old('title') }}"
           required>
</div>

<div class="form-group">
    <label for="body">Body</label>
    <wysiwyg name="body"></wysiwyg>
    {{--<textarea class="form-control"--}}
              {{--name="body"--}}
              {{--id="body"--}}
              {{--rows="8"--}}
              {{--required>--}}
              {{--{{ isset($thread) ? $thread->body : old('body') }}--}}
              {{--</textarea>--}}
</div>
<div class="form-group">
    <label for="image">Select image</label>
    <input class="form-control"
           type="file"
           name="image"
           id="image">
</div>

@if(count($errors))
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
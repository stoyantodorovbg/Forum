@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a new thread</div>
                    <div class="card-body">
                        <form method="POST" action="/threads" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                            {{--<form class="form-horizontal" role="form">--}}
                            <div class="form-group">
                                <label for="channel_id">Choose a channel</label>
                                <select class="form-control"
                                       name="channel_id"
                                       id="channel_id"
                                       value="{{ old('channel_id') }}"
                                       required>
                                    <option value="">
                                        Choose one
                                    </option>
                                    @foreach($channels as $channel)
                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? "selected" : "" }}>
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
                                       value="{{ old('title') }}"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea class="form-control"
                                       name="body"
                                       id="body"
                                       rows="8"
                                       required>
                                    {{ old('body') }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Select image</label>
                                <input class="form-control"
                                       type="file"
                                       name="image"
                                       id="image">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default" type="submit">
                                    Publish
                                </button>
                            </div>

                            @if(count($errors))
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

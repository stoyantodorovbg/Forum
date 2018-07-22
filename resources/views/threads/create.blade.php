@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a new thread</div>
                    <div class="card-body">
                        <form method="POST" action="/threads">
                            {{ csrf_field() }}
                            
                            {{--<form class="form-horizontal" role="form">--}}
                                <div class="row form-group form-horizontal">
                                    <div class="col-lg-5 custom-row">
                                        <label for="input1" style="height: 60px;" class="control-label custom-label">
                                            Labdas kjas kljas dlkjasd lksjd el1 Labdas kjas kljas dlkjasd lksjd el1
                                        </label>
                                        <input type="text" class="form-control input-custom" id="input1" placeholder="Input1">
                                    </div>
                                    <div class="col-lg-5 custom-row">
                                        <label for="input2" style="height: 60px;" class="control-label custom-label">
                                            Label2
                                        </label>
                                        <input type="password" class="form-control input-custom" id="input2" placeholder="Input2">
                                    </div>
                                </div>
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

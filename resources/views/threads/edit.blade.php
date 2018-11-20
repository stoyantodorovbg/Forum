@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update the thread</div>
                    <div class="card-body">
                        <form method="POST" action="/threads/{{ $thread->slug }}" enctype="multipart/form-data">
                            @csrf

                            @method('PUT')

                            @include('threads._fields')

                            <div class="form-group">
                                <button class="btn btn-default" type="submit">
                                    Edit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
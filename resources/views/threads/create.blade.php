@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ label('create_new_thread') }}</div>
                    <div class="card-body">
                        <form method="POST" action="/threads" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include('threads._fields')

                            <div class="form-group">
                                <button class="btn btn-default" type="submit">
                                    {{ label('publish') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

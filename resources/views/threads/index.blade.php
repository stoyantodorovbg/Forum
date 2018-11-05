@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">
                    <h1>
                        FORUM THREADS
                    </h1>
                </div>
                @include('threads._list')

                {{ $threads->render() }}
            </div>
        </div>
    </div>
@endsection

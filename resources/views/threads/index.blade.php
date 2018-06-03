@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forum threads</div>
                    <div class="card-body">
                        @foreach( $threads as $thread)
                            <article>
                                <h1>
                                    {{ $thread->title }}
                                </h1>
                                <p>
                                    {{ $thread->body }}
                                </p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

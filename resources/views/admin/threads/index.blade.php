@extends('admin.layouts.app')

@section('content')
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">Edit</th>
                <th scope="col">Title</th>
                <th scope="col">Creator</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($threads as $thread)
                <tr>
                    <th scope="row">
                        <button class="btn btn-success btn-sm">
                            <i class="glyphicon glyphicon-pencil">&#x270f;</i>
                        </button>
                    </th>
                    <td>{{ $thread->title }}</td>
                    <td>{{ $thread->owner->name }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
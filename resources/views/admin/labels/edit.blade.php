@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.labels.update', ['id' => $label->id]) }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_label') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.labels') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/labels">{{ label('save_exit') }}</button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('system_name') }}</label>
                <div>
                    <input class="form-control" name="system_name" value="{{ $label->system_name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('body') }}</label>
                <div>
                    <input class="form-control" name="default_content" value="{{ $label->default_content }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('default_label_language') }}</label>
                <select class="form-control" name="default_language_id">
                    @foreach($languages as $language)
                        <option {{ $language->id == $label->default_language_id ? "selected" : ""}}
                            value="{{ $language->id }}">
                            {{ ucfirst($language->title) }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if($translations->count() > 0)
                <div class="font-weight-bold">{{ label('translations') }}</div>

                <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{ label('language') }}</th>
                        <th scope="col">{{ label('body') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($translations as $translation)
                        <td>{{ ucfirst($translation->language->title) }} </td>
                        <td>{{ $translation->content }}</td>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>{{ label('translations_empty') }}</p>
            @endif
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.labels') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/labels">{{ label('save_exit') }}</button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@extends('admin.layouts.app')

@section('content')
    <form method="POST" action="{{ route('admin.menus.store') }}">
        {{ csrf_field() }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>{{ label('create_menu') }}</h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.menus') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/menus">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('status') }}</label>
                <select class="form-control" name="status">
                    <option value="0">
                        {{ label('inactive') }}
                    </option>
                    <option value="1">
                        {{ label('active') }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('description') }}</label>
                <div>
                    <textarea class="form-control" rows="10" name="description"></textarea>
                </div>
            </div>
            @if(!isset($menuItems))
                <div class="info-model">
                    <span class="info-label">{{ label('assigned_to') }}</span>
                    <span class="info-data">
                        {{ $menuItem->title }} {{ label('menu_item_from') }} {{ $menuItem->menu->title }} {{ label('menu') }}
                    </span>
                </div>
            @else
                <div class="form-group">
                    <label class="col-form-label">{{ label('assign_to') }}</label>
                    <select class="form-control" name="menu_item_id">
                        <option value="">
                            {{ label('it_is_main_menu') }}
                        </option>
                        @foreach($menuItems as $menuItem)
                            <option value="{{ $menuItem->id }}">
                                {{ $menuItem->title }} {{ label('from_menu') }} {{ $menuItem->menu->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.menus') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" value="/admin/menus">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
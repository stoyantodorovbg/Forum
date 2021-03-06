@extends('admin.layouts.app')

@section('content')

    <form method="POST" action="{{ route('admin.menus.update', ['id' => $menu->id]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="container-admin-form col-sm-11">
            <div class="admin-form-header">
                <h1>
                    {{ label('edit_menu') }}
                </h1>
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.menus') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" name="exit" value="true">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
            @if(isset($menu->parentMenuItem))
                <div class="info-model">
                    <span class="info-label">{{ label('assigned_to') }}</span>
                    <span class="info-data">
                        {{ $menu->parentMenuItem->title }} {{ label('menu_item_from') }} {{ $menu->parentMenuItem->menu->title }} {{ label('menu') }}
                    </span>
                </div>
                <div class="form-group">
                    <label class="col-form-label">{{ label('assign_to') }}</label>
                    <select class="form-control" name="menu_item_id">
                        @foreach($menuItems as $menuItem)
                            <option value="{{ $menuItem->id }}"
                                {{ $menuItem->id == $menu->parentMenuItem->id ? 'selected' : ''  }}>
                                {{ $menuItem->title }} {{ label('from_menu') }} {{ $menuItem->menu->title }}
                            </option>
                        @endforeach
                        <option value="">
                            {{ label('it_is_main_menu') }}
                        </option>
                    </select>
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
            <div class="form-group">
                <label class="col-form-label">{{ label('status') }}</label>
                <select class="form-control" name="status">
                    <option {{ $menu->status ? 'selected' : '' }} value="1">
                        {{ label('active') }}
                    </option>
                    <option {{ !$menu->status ? 'selected' : '' }} value="0">
                        {{ label('inactive') }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('title') }}</label>
                <div>
                    <input class="form-control" name="title" value="{{ $menu->title }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">{{ label('description') }}</label>
                <div>
                    <textarea class="form-control" rows="10" id="comment" name="description">{{ $menu->description }}</textarea>
                </div>
            </div>
            <menu-item-table
                :items="{{ $menu->menuItems }}"
                :menu="{{ $menu }}"
                :labels="{
                    'position': '{{ 'position' }}',
                    'status': '{{ label('status') }}',
                    'active': '{{ label('active') }}',
                    'inactive': '{{ label('inactive') }}',
                    'choose_one': '{{ label('choose_one') }}',
                    'title': '{{ label('title') }}',
                    'add_a_menu_item': '{{ label('add_a_menu_item') }}',
                    'save_the_menu_item': '{{ label('save_the_menu_item') }}',
                    'edit_menu_item': '{{ label('edit_menu_item') }}',
                    'editing_menu_item': '{{ label('editing_menu_item') }}',
                    'nested_menu': '{{ label('nested_menu') }}',
                    'edit_nested_menu': '{{ label('edit_nested_menu') }}',
                    'add_nested_menu': '{{ label('add_nested_menu') }}',
                    'save_menu_item': '{{ label('save_menu_item') }}',
                    'edit': '{{ label('edit') }}',
                    'cancel': '{{ label('cancel') }}',
                    'delete': '{{ label('delete') }}',
                    'title': '{{ label('title') }}',
                    'link': '{{ label('link') }}',
                    'description': '{{ label('description') }}',
                    'position': '{{ label('position') }}',
                }">
            </menu-item-table>
            <translation-table
                :translations="{{ $translations }}"
                :languages="{{ $languages }}"
                :item="{{ $menu }}"
                :labels="{
                    'add_a_translation': '{{ label('add_a_translation') }}',
                    'language': '{{ label('language') }}',
                    'description': '{{ label('description') }}',
                    'save_translation': '{{ label('save_translation') }}',
                    'edit_translation': '{{ label('edit_translation') }}',
                    'edit': '{{ label('edit') }}',
                    'cancel': '{{ label('cancel') }}',
                    'delete': '{{ label('delete') }}',
                }"
                :text_input_labels="{
                    'title': ['{{ label('title') }}', 'title'],
                }"
                :textarea_input_labels="{
                    'description': ['{{ label('description') }}', 'description'],
                }"
                :item_name="'menu'"
                :text_inputs="['title']"
                :textarea_inputs="['description']"
                :url="'/admin/menu-translations/'">
            </translation-table>
            <div class="admin-form-footer">
                <div class="admin-form-buttons">
                    <a href="{{ route('admin.menus') }}">
                        <button class="btn btn-info" type="button">{{ label('exit_without_saving') }}</button>
                    </a>
                    <button class="btn btn-danger saveAndExit" name="exit" value="true">
                        {{ label('save_exit') }}
                    </button>
                    <button class="btn btn-danger">{{ label('save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
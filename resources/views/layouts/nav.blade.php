<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <form class="select-language" method="POST" action="{{ route('change.language') }}">
            {{ csrf_field() }}
            <select class="form-control" onchange="this.form.submit()" name="language_id">
                @if(!isset($_COOKIE['language'])))
                    <option selected value="">{{ label('select_language') }}</option>
                @endif
                @foreach(getLanguages() as $language)
                    @if(isset($_COOKIE['language']) && $_COOKIE['language'] == $language->id)
                        <option selected value="{{ $language->id }}">{{ label($language->title) }}</option>
                    @else
                        <option value="{{ $language->id }}">{{ label($language->title) }}</option>
                    @endif
                @endforeach
            </select>
        </form>
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ label('forum') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li>
                    <a class="nav-link" href="{{ route('threads.create') }}">{{ label('create_thread') }}</a>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle"
                                type="button"
                                id="dropdownMenuButton"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                            {{ label('channels') }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($channels as $channel)
                                <a class="dropdown-item" href="/channels/{{ $channel->slug }}">{{ $channel->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle"
                                type="button"
                                id="dropdownMenuButton"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                            {{ label('browse_threads') }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('threads.index') }}">All Threads</a>
                            @if(auth()->check())
                                <a class="dropdown-item" href="/threads?by={{ auth()->user()->name }}">My threads</a>
                            @endif
                            <a class="dropdown-item" href="/threads?popular=1">Popular threads</a>
                            <a class="dropdown-item" href="/threads?unanswered=1">Unanswered threads</a>

                        </div>
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ label('login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ label('register') }}</a></li>
                @else
                    <user-notifications></user-notifications>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        {{--<div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}

                        {{--</div>--}}

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile', Auth::user()) }}">
                            My profile
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="sidebar">
    <nav class="sidebar-nav">
        @if($sideMenu)
            <menu-component
                :menu="{{ $sideMenu }}"
                :classes="{
                    'ul': '',
                    'li': '',
                    'a': '',
                    'child_classes': {
                        'ul': '',
                        'li': '',
                        'a': '',
                        'child_classes': {
                            'ul': '',
                            'li': '',
                            'a': '',
                        },
                    },
                }">
            </menu-component>
        @endif
        {{--<ul class="nav">--}}
            {{--<li class="nav-title">Forum</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<i class="nav-icon icon-drop"></i> Threads</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<i class="nav-icon icon-pencil"></i> Replies</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<i class="nav-icon icon-pencil"></i> Channels</a>--}}
            {{--</li>--}}
            {{--<li class="nav-title">Blog</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<i class="nav-icon icon-drop"></i> Articles</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<i class="nav-icon icon-pencil"></i> News</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<i class="nav-icon icon-pencil"></i> Images</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<i class="nav-icon icon-pencil"></i> Links</a>--}}
            {{--</li>--}}
            {{--<li class="nav-title">Users</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<i class="nav-icon icon-drop"></i> Users</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<i class="nav-icon icon-pencil"></i> News</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<i class="nav-icon icon-pencil"></i> Images</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
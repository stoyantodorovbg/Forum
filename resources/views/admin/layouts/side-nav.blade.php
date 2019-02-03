<nav class="admin-side">
    @if($sideMenu)
        <menu-component
            :menu="{{ $sideMenu }}"
            :classes="{
                'ul': 'admin-side-nav-main',
                'li': 'main-item',
                'a': 'main-link',
                'child_classes': {
                    'ul': 'admin-side-nav-child',
                    'li': 'child-item',
                    'a': 'child-link',
                    'child_classes': {
                        'ul': 'admin-side-nav-child',
                        'li': 'child-item',
                        'a': 'child-link',
                    },
                },
            }">
        </menu-component>
    @endif
</nav>
<template>
    <ul :class="'menu ' + classes.ul">
        <li
            v-for="menuItem in menu.menu_items"
            :class="'menu-item ' + classes.li">
                <a
                    :href="menuItem.link"
                    :class="'menu-item-link ' + classes.a">
                    {{ menuItem.title }}
                </a>
                <menu-component
                    v-if="menuItem.child_menu != null"
                    :menu="menuItem.child_menu"
                    :classes="classes.child_classes">
                </menu-component>
        </li>
    </ul>
</template>

<script>
    export default {
        props: [
            'menu',
            'classes'
        ],

    }
</script>
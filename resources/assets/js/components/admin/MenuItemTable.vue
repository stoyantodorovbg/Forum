<template>
    <div class="container">
        <!--<add-menu-item></add-menu-item>-->
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">{{ labels['edit'] }}</th>
                <th scope="col">{{ labels['status'] }}</th>
                <th scope="col">{{ labels['position'] }}</th>
                <th scope="col">{{ labels['title'] }}</th>
                <th scope="col">{{ labels['delete'] }}</th>
            </tr>
            </thead>
            <tbody>
            <menu-item
                v-for="menuItem in items"
                :key="menuItem.id"
                :menuItem="menuItem">
            </menu-item>
            </tbody>
        </table>
    </div>
</template>

<script>
    import MenuItem from "./MenuItem";
    import AddMenuItem from "./AddMenuItem";

    export default {
        components: {MenuItem, AddMenuItem},

        props: [
            'items',
            'menu',
            'labels',
        ],

        // data() {
        //     return {
        //         dataMenuItems: this.menuItems,
        //     }
        // }
    }
</script>
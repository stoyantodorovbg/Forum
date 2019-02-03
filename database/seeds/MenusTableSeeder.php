<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // MENU Admin Side Menu id 1
        DB::table('menus')->insert([
            'title' => 'Admin Side Menu',
            'description' => 'Lists the editable content in the back-office',
            'status' => 1,
        ]);

        // Admin Side Menu id 1
        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'position' => 1,
            'title' => 'Forum',
        ]);

        // Admin Side Menu id 2
        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'position' => 2,
            'title' => 'Blog',
        ]);

        // Admin Side Menu id 3
        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'position' => 3,
            'title' => 'Users',
        ]);

        // Admin Side Menu id 4
        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'position' => 4,
            'title' => 'System',
        ]);

        // MENU Forum id 2
        DB::table('menus')->insert([
            'menu_item_id' => 1,
            'title' => 'Forum',
            'description' => 'Lists the editable content for the Forum in the back-office',
            'status' => 1,
        ]);

        // Forum id 5
        DB::table('menu_items')->insert([
            'menu_id' => 2,
            'position' => 1,
            'title' => 'Channels',
            'link' => '/admin/channels'
        ]);

        // Forum id 6
        DB::table('menu_items')->insert([
            'menu_id' => 2,
            'position' => 2,
            'title' => 'Threads',
            'link' => '/admin/threads'
        ]);

        // Forum id 7
        DB::table('menu_items')->insert([
            'menu_id' => 2,
            'position' => 3,
            'title' => 'Replies',
            'link' => '/admin/replies'
        ]);

        // MENU Blog id 3
        DB::table('menus')->insert([
            'menu_item_id' => 2,
            'title' => 'Blog',
            'description' => 'Lists the editable content for the Blog in the back-office',
            'status' => 1,
        ]);

        // Blog id 8
        DB::table('menu_items')->insert([
            'menu_id' => 3,
            'position' => 1,
            'title' => 'Articles',
            'link' => '/admin/articles'
        ]);

        // Blog id 9
        DB::table('menu_items')->insert([
            'menu_id' => 3,
            'position' => 2,
            'title' => 'Comments',
            'link' => '/admin/comments'
        ]);

        // MENU Users id 4
        DB::table('menus')->insert([
            'menu_item_id' => 3,
            'title' => 'Users',
            'description' => 'Lists the Users in the back-office',
            'status' => 1,
        ]);

        // Users id 10
        DB::table('menu_items')->insert([
            'menu_id' => 4,
            'position' => 1,
            'title' => 'Users',
            'link' => '/admin/users'
        ]);

        // MENU System id 5
        DB::table('menus')->insert([
            'menu_item_id' => 4,
            'title' => 'System',
            'description' => 'Lists the System manageable content in the back-office',
            'status' => 1,
        ]);

        // System id 11
        DB::table('menu_items')->insert([
            'menu_id' => 5,
            'position' => 1,
            'title' => 'Labels',
            'link' => '/admin/labels'
        ]);

        // System id 12
        DB::table('menu_items')->insert([
            'menu_id' => 5,
            'position' => 2,
            'title' => 'Pages',
            'link' => '/admin/pages'
        ]);

        // System id 13
        DB::table('menu_items')->insert([
            'menu_id' => 5,
            'position' => 3,
            'title' => 'Blocks',
            'link' => '/admin/blocks'
        ]);

        // System id 14
        DB::table('menu_items')->insert([
            'menu_id' => 5,
            'position' => 4,
            'title' => 'Menus',
            'link' => '/admin/menus'
        ]);

        // System id 15
        DB::table('menu_items')->insert([
            'menu_id' => 5,
            'position' => 5,
            'title' => 'Roles',
            'link' => '/admin/roles'
        ]);

        // System id 16
        DB::table('menu_items')->insert([
            'menu_id' => 5,
            'position' => 6,
            'title' => 'Permissions',
            'link' => '/admin/permissions'
        ]);

        // System id 19
        DB::table('menu_items')->insert([
            'menu_id' => 5,
            'position' => 7,
            'title' => 'Rights',
            'link' => '/admin/rights'
        ]);

        // System id 20
        DB::table('menu_items')->insert([
            'menu_id' => 5,
            'position' => 8,
            'title' => 'Languages',
            'link' => '/admin/languages'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class LabelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labels')->insert([
            'system_name' => 'thread',
            'default_content' => 'Thread',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'user',
            'default_content' => 'User',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'created_at',
            'default_content' => 'Created at',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'updated_at',
            'default_content' => 'Updated at',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'save',
            'default_content' => 'Save',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'save_exit',
            'default_content' => 'Save and Exit',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'exit_without_saving',
            'default_content' => 'Exit without saving',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'body',
            'default_content' => 'Content',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'select_language',
            'default_content' => 'Select A Language',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'English',
            'default_content' => 'English',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'Bulgarian',
            'default_content' => 'Bulgarian',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'forum',
            'default_content' => 'Forum',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'create_thread',
            'default_content' => 'Create a thread',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'channels',
            'default_content' => 'Themes',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'browse_threads',
            'default_content' => 'Browse threads',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'login',
            'default_content' => 'Login',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'register',
            'default_content' => 'Register',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'forum_threads',
            'default_content' => 'FORUM THREADS',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'search',
            'default_content' => 'Search',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'enter–search_criterion',
            'default_content' => 'Enter a search criterion',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'trending_threads',
            'default_content' => 'Trending Threads',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'no_results',
            'default_content' => 'There are no relevant results.',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'posted_by',
            'default_content' => 'Posted by',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'comment',
            'default_content' => 'comments',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'comments',
            'default_content' => 'comments',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'visit',
            'default_content' => 'visit',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'visits',
            'default_content' => 'visits',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'create_new_thread',
            'default_content' => 'Create a new thread',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'publish',
            'default_content' => 'Publish',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'choose_channel',
            'default_content' => 'Choose a theme',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'choose_one',
            'default_content' => 'Choose one',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'title',
            'default_content' => 'Title',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'add_photo',
            'default_content' => 'Add a Photo',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'posted',
            'default_content' => 'posted',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'before',
            'default_content' => 'before',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'delete',
            'default_content' => 'Delete',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'edit',
            'default_content' => 'Edit',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'cancel',
            'default_content' => 'Cancel',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'no_activities_for_this_user',
            'default_content' => 'There is no activity for this user yet.',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'published_a',
            'default_content' => 'published a',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'replied_to_a',
            'default_content' => 'replied to a',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'favorited_a_reply_to_this',
            'default_content' => 'favorited a reply to this thread',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'email_address',
            'default_content' => 'E-Mail Address',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'password',
            'default_content' => 'Password',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'remember_me',
            'default_content' => 'Remember me',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'forgot_your_password',
            'default_content' => 'Forgot Your Password?',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'name',
            'default_content' => 'Name',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'confirm_password',
            'default_content' => 'Confirm Password',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'published_from',
            'default_content' => 'Published from',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'create_a_reply',
            'default_content' => 'Create a Reply',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'select_a_thread',
            'default_content' => 'Select a Thread',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'edit_reply',
            'default_content' => 'Edit Reply',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'create_a_thread',
            'default_content' => 'Create a Thread',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'channel',
            'default_content' => 'Theme',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'select_channel',
            'default_content' => 'Select a Theme',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'published_on',
            'default_content' => 'Published on',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'by',
            'default_content' => 'by',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'create_a_label',
            'default_content' => 'Create a label',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'system_name',
            'default_content' => 'System name',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'edit_label',
            'default_content' => 'Edit label',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'edit_thread',
            'default_content' => 'Edit thread',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'default_label_language',
            'default_content' => 'Default Language',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'translations',
            'default_content' => 'Translations',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'language',
            'default_content' => 'Language',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'translations_empty',
            'default_content' => 'There is no translations for this item.',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'add_a_translation',
            'default_content' => 'Add Translation',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'save_translation',
            'default_content' => 'Save this Translation',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'edit_translation',
            'default_content' => 'Edit Translation',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'add_translation_on_with_space',
            'default_content' => 'Add Translation on ',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'delete_with_space',
            'default_content' => 'Delete ',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'space_with_translation',
            'default_content' => ' translation',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'create_role',
            'default_content' => 'Create role',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'permissions',
            'default_content' => 'Permissions',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'add_permission',
            'default_content' => 'Choose a permission to add',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'role_without_permissions',
            'default_content' => 'There is no permissions for this role.',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'edit_role',
            'default_content' => 'Edit role',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'permission_without_rights',
            'default_content' => 'There is no rights for this permission.',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'add_right',
            'default_content' => 'Choose a right to add',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'edit_permission',
            'default_content' => 'Edit permission',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'description',
            'default_content' => 'Description',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'edit_right',
            'default_content' => 'Edit right',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'create_right',
            'default_content' => 'Create a right',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'create_permission',
            'default_content' => 'Create a permission',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'status',
            'default_content' => 'Status',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'active',
            'default_content' => 'Active',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'inactive',
            'default_content' => 'Inactive',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'search_status',
            'default_content' => 'Search by status',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'from',
            'default_content' => 'From',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'to',
            'default_content' => 'To',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'search_by_title',
            'default_content' => 'Search by title',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'search_by_published',
            'default_content' => 'Search by author',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'search_by_body',
            'default_content' => 'Search by content',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'search_by_thread',
            'default_content' => 'Search by thread',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'search_by_system_name',
            'default_content' => 'Search by system name',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'search_by_default_content',
            'default_content' => 'Search by default content',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'edit_channel',
            'default_content' => 'Edit a channel',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'create_channel',
            'default_content' => 'Create new channel',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'slug',
            'default_content' => 'Slug',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'create_language',
            'default_content' => 'Create new language',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'edit_language',
            'default_content' => 'Edit language',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'short_title',
            'default_content' => 'Short title',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'roles',
            'default_content' => 'Roles',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'edit_user',
            'default_content' => 'Edit user',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'create_user',
            'default_content' => 'Create new user',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'add_role',
            'default_content' => 'Add a role',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'user_without_roles',
            'default_content' => 'The user have no roles',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'user_without_permissions',
            'default_content' => 'The user have no permissions',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'search_by_name',
            'default_content' => 'Search by name',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'mail_confirmation',
            'default_content' => 'Mail confirmation',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'confirmed',
            'default_content' => 'Confirmed',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'not_confirmed',
            'default_content' => 'Not confirmed',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'email',
            'default_content' => 'Email',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'search_by_email',
            'default_content' => 'Search by email',
            'default_language_id' => 1,
        ]);
    }
}

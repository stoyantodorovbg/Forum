<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //FullBackOfficeCRUD id 1
        DB::table('permissions')->insert([
            'system_name' => 'Full_BackOffice_CRUD',
            'title' => 'FullBackOfficeCRUD',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 1,
            'right_id' => 1,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 1,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 1,
            'right_id' => 3,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 1,
        ]);

        DB::table('roles_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 1,
        ]);

        //FullBackOfficeOnlyRead id 2
        DB::table('permissions')->insert([
            'system_name' => 'Full_BackOffice_Only_Read',
            'title' => 'FullBackOfficeOnlyRead',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 2,
            'right_id' => 1,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 2,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 2,
            'right_id' => 8,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 2,
            'right_id' => 4,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 2,
        ]);

        //ThreadsBackOfficeCRUD id 3
        DB::table('permissions')->insert([
            'system_name' => 'Thread_BackOffice_CRUD',
            'title' => 'ThreadsBackOfficeCRUD',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 3,
            'right_id' => 10,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 3,
            'right_id' => 1,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 3,
            'right_id' => 2,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 3,
        ]);

        //ThreadsBackOfficeOnlyRead id 4
        DB::table('permissions')->insert([
            'system_name' => 'Thread_BackOffice_Only_Read',
            'title' => 'ThreadsBackOfficeOnlyRead',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 4,
            'right_id' => 10,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 4,
            'right_id' => 1,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 4,
            'right_id' => 8,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 4,
            'right_id' => 4,
        ]);

        //RepliesBackOfficeCRUD id 5
        DB::table('permissions')->insert([
            'system_name' => 'Reply_BackOffice_CRUD',
            'title' => 'RepliesBackOfficeCRUD',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 5,
            'right_id' => 11,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 5,
            'right_id' => 1,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 5,
            'right_id' => 2,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 5,
        ]);

        //RepliesBackOfficeOnlyRead id 6
        DB::table('permissions')->insert([
            'system_name' => 'Reply_BackOffice_Only_Read',
            'title' => 'RepliesBackOfficeOnlyRead',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 6,
            'right_id' => 11,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 6,
            'right_id' => 1,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 6,
            'right_id' => 8,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 6,
            'right_id' => 4,
        ]);

        //LabelsBackOfficeCRUD id 7
        DB::table('permissions')->insert([
            'system_name' => 'Label_BackOffice_CRUD',
            'title' => 'LabelsBackOfficeCRUD',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 7,
            'right_id' => 12,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 7,
            'right_id' => 1,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 7,
            'right_id' => 2,
        ]);

        //LabelsBackOfficeOnlyRead id 8
        DB::table('permissions')->insert([
            'system_name' => 'Label_BackOffice_Only_Read',
            'title' => 'LabelsBackOfficeOnlyRead',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 8,
            'right_id' => 12,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 8,
            'right_id' => 1,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 8,
            'right_id' => 8,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 8,
            'right_id' => 4,
        ]);

        //ThreadsPublish id 9
        DB::table('permissions')->insert([
            'system_name' => 'Thread_Publish',
            'title' => 'ThreadsPublish',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 9,
            'right_id' => 10,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 9,
            'right_id' => 9,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 4,
            'permission_id' => 9,
        ]);

        //RepliesPublish id 10
        DB::table('permissions')->insert([
            'system_name' => 'Reply_Publish',
            'title' => 'RepliesPublish',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 10,
            'right_id' => 9,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 10,
            'right_id' => 11,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 4,
            'permission_id' => 10,
        ]);
    }
}

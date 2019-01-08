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
        //AdminBackOffice id 1
        DB::table('permissions')->insert([
            'system_name' => 'Admin_BackOffice',
            'title' => 'FullBackOffice',
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

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 1,
        ]);

        DB::table('roles_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 1,
        ]);

        //ThreadsBackOfficeUpdate id 2
        DB::table('permissions')->insert([
            'system_name' => 'Thread_BackOffice_Update',
            'title' => 'ThreadsBackOfficeUpdate',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 2,
            'right_id' => 7,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 2,
            'right_id' => 2,
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

        //RepliesBackOfficeUpdate id 3
        DB::table('permissions')->insert([
            'system_name' => 'Reply_BackOffice_Update',
            'title' => 'RepliesBackOfficeUpdate',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 3,
            'right_id' => 8,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 3,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 3,
            'right_id' => 4,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 3,
        ]);

        //LabelsBackOfficeUpdate id 4
        DB::table('permissions')->insert([
            'system_name' => 'Label_BackOffice_Update',
            'title' => 'LabelsBackOfficeUpdate',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 4,
            'right_id' => 9,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 4,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 4,
            'right_id' => 4,
        ]);

        //ThreadsStore id 5
        DB::table('permissions')->insert([
            'system_name' => 'Thread_Store',
            'title' => 'ThreadsStore',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 5,
            'right_id' => 7,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 5,
            'right_id' => 3,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 4,
            'permission_id' => 5,
        ]);

        //RepliesStore id 6
        DB::table('permissions')->insert([
            'system_name' => 'Reply_Store',
            'title' => 'RepliesStore',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 6,
            'right_id' => 6,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 6,
            'right_id' => 3,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 4,
            'permission_id' => 6,
        ]);

        //RepliesBackOfficeIndex id 7
        DB::table('permissions')->insert([
            'system_name' => 'Reply_BackOffice_Index',
            'title' => 'RepliesBackOfficeIndex',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 7,
            'right_id' => 8,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 7,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 7,
            'right_id' => 10,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 7,
        ]);

        //RepliesBackOfficeEdit id 8
        DB::table('permissions')->insert([
            'system_name' => 'Reply_BackOffice_Edit',
            'title' => 'RepliesBackOfficeEdit',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 8,
            'right_id' => 8,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 8,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 8,
            'right_id' => 11,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 8,
        ]);

        //ThreadsBackOfficeDestroy id 9
        DB::table('permissions')->insert([
            'system_name' => 'Thread_BackOffice_Destroy',
            'title' => 'ThreadsBackOfficeDestroy',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 9,
            'right_id' => 7,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 9,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 9,
            'right_id' => 5,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 9,
        ]);

        //ThreadsBackOfficeStore id 10
        DB::table('permissions')->insert([
            'system_name' => 'Thread_BackOffice_Store',
            'title' => 'ThreadsBackOfficeStore',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 10,
            'right_id' => 7,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 10,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 10,
            'right_id' => 3,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 10,
        ]);

        //LabelsBackOfficeDestroy id 11
        DB::table('permissions')->insert([
            'system_name' => 'Label_BackOffice_Destroy',
            'title' => 'LabelsBackOfficeDestroy',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 11,
            'right_id' => 9,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 11,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 11,
            'right_id' => 5,
        ]);

        //LabelsBackOfficeStore id 11
        DB::table('permissions')->insert([
            'system_name' => 'Label_BackOffice_Store',
            'title' => 'LabelsBackOfficeStore',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 11,
            'right_id' => 9,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 11,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 11,
            'right_id' => 3,
        ]);

        //ThreadsBackOfficeIndex id 12
        DB::table('permissions')->insert([
            'system_name' => 'Thread_BackOffice_Index',
            'title' => 'ThreadsBackOfficeIndex',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 12,
            'right_id' => 7,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 12,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 12,
            'right_id' => 10,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 12,
        ]);

        //ThreadsBackOfficeEdit id 13
        DB::table('permissions')->insert([
            'system_name' => 'Thread_BackOffice_Edit',
            'title' => 'ThreadsBackOfficeEdit',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 13,
            'right_id' => 7,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 13,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 13,
            'right_id' => 11,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 13,
        ]);

        //HomeBackOfficeIndex id 14
        DB::table('permissions')->insert([
            'system_name' => 'Home_BackOffice_Index',
            'title' => 'HomeBackOfficeIndex',
        ]);

        //rights
        DB::table('permissions_rights')->insert([
            'permission_id' => 14,
            'right_id' => 13,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 14,
            'right_id' => 2,
        ]);

        DB::table('permissions_rights')->insert([
            'permission_id' => 14,
            'right_id' => 10,
        ]);

        //roles
        DB::table('roles_permissions')->insert([
            'role_id' => 3,
            'permission_id' => 14,
        ]);
    }
}

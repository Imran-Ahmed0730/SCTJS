<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleSuperAdmin = Role::create(['name' => 'super-admin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser = Role::create(['name' => 'user']);

        $permissions = [
            'admin.dashboard',

            'student.create',
            'student.view',
            'student.edit',
            'student.update',
            'student.delete',
            'student.details',

            'branch.create',
            'branch.view',
            'branch.edit',
            'branch.update',
            'branch.delete',
            'branch.details',

            'session.create',
            'session.view',
            'session.edit',
            'session.update',
            'session.delete',
            'session.details',

            'course.create',
            'course.view',
            'course.edit',
            'course.update',
            'course.delete',
            'course.details',

            'notice.create',
            'notice.view',
            'notice.edit',
            'notice.update',
            'notice.delete',
            'notice.details',

            'payment.create',
            'payment.view',
            'payment.edit',
            'payment.update',
            'payment.delete',
            'payment.details',

            'account.bill-summary',
            'account.bills'
        ];

        for($i = 0; $i<count($permissions); $i++){
            $permission = Permission::create(['name' => $permissions[$i]]);
            $roleSuperAdmin->givePermissionTo($permission);
            $permission->assignRole($roleSuperAdmin);
        }
    }
}

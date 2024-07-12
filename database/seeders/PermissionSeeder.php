<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $role_admin = Role::updateOrCreate(
            ['name' => 'admin'],
            ['name' => 'admin']
        );

        $role_user = Role::updateOrCreate(
            ['name' => 'user'],
            ['name' => 'user']
        );

        $permission_admin = Permission::updateOrCreate(
            ['name' => 'view_dashboard', 'guard_name' => 'web'],
            ['name' => 'view_dashboard', 'guard_name' => 'web']
        );

        $permission_user = Permission::updateOrCreate(
            ['name' => 'view_chart_on_dashboard', 'guard_name' => 'web'],
            ['name' => 'view_chart_on_dashboard', 'guard_name' => 'web']
        );

        if (!$role_admin->hasPermissionTo($permission_admin)) {
            $role_admin->givePermissionTo($permission_admin);
        }

        if (!$role_admin->hasPermissionTo($permission_user)) {
            $role_admin->givePermissionTo($permission_user);
        }

        if (!$role_user->hasPermissionTo($permission_user)) {
            $role_user->givePermissionTo($permission_user);
        }

        $user = User::find(11);

        if ($user) {
            $user->assignRole('user');
        } else {
            $this->command->info('User with ID 1 not found.');
        }
    }
}

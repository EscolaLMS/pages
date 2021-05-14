<?php

namespace EscolaLms\Pages\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::findOrCreate('admin', 'api');
        $permissions = ['delete:pages', 'insert:pages', 'list:pages', 'update:pages'];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'api');
        }

        $admin->givePermissionTo($permissions);
    }
}

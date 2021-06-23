<?php

namespace EscolaLms\Pages\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * @todo remove neccesity of using 'web' guard
 */
class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $apiAdmin = Role::findOrCreate('admin', 'api');
        $webAdmin = Role::findOrCreate('admin', 'web');
        $permissions = ['delete pages', 'create pages', 'update pages'];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'api');
            Permission::findOrCreate($permission, 'web');
        }

        $apiAdmin->givePermissionTo($permissions);
        $webAdmin->givePermissionTo($permissions);
    }
}

<?php

namespace EscolaLms\Pages\Database\Seeders;

use EscolaLms\Pages\Enums\PagesPermissionsEnum;
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
        $permissions = [
            PagesPermissionsEnum::PAGE_LIST,
            PagesPermissionsEnum::PAGE_READ,
            PagesPermissionsEnum::PAGE_DELETE,
            PagesPermissionsEnum::PAGE_UPDATE,
            PagesPermissionsEnum::PAGE_CREATE,
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'api');
            Permission::findOrCreate($permission, 'web');
        }

        $apiAdmin->givePermissionTo($permissions);
        $webAdmin->givePermissionTo($permissions);
    }
}

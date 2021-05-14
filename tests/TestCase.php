<?php

namespace EscolaLms\Pages\Tests;

use EscolaLms\Core\EscolaLmsServiceProvider;
use EscolaLms\Core\Models\User;
use EscolaLms\Pages\Database\Seeders\DatabaseSeeder;
use EscolaLms\Pages\EscolaLmsPagesServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\PassportServiceProvider;
use Spatie\Permission\PermissionServiceProvider;

class TestCase extends \EscolaLms\Core\Tests\TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    protected function getPackageProviders($app): array
    {
        return [
            ...parent::getPackageProviders($app),
            EscolaLmsPagesServiceProvider::class,
            EscolaLmsServiceProvider::class,
            PassportServiceProvider::class,
            PermissionServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        $app['config']->set('passport.client_uuids', false);
    }

    protected function authenticateAsAdmin()
    {
        $user = User::factory()->create()->assignRole('admin');
        Auth::setUser($user);
    }
}

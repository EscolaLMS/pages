<?php

namespace EscolaLms\Pages\Tests;

use EscolaLms\Core\EscolaLmsServiceProvider;
use EscolaLms\Core\Models\User;
use EscolaLms\Pages\Database\Seeders\DatabaseSeeder;
use EscolaLms\Pages\EscolaLmsPagesServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\PassportServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestCase extends \EscolaLms\Core\Tests\TestCase
{
    use DatabaseTransactions;

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
            PassportServiceProvider::class,
            PermissionServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
    }

    protected function authenticateAsAdmin()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user = $user->assignRole('admin');
        Auth::guard()->setUser($user);
    }
}

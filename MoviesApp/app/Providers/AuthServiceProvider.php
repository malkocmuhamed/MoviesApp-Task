<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-movies', function ($user) {
            return $user->role === 2; // Assuming User::USER_ROLE is the user role ID
        });
        Gate::define('manage-movies', function ($user) {
            return $user->role === 1; // Assuming User::ADMIN_ROLE is the admin role ID
        });
    }
}

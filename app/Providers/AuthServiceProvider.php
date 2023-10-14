<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Check if user is admin
        Gate::define('admin', function ($user)
        {
            return $user->hasAnyRoles(['admin']);
        });

        // Check if user is interviewer
        Gate::define('interviewer', function ($user)
        {
            return $user->hasAnyRoles(['interviewer']);
        });

        // Check if user is ceo
        Gate::define('ceo', function ($user)
        {
            return $user->hasAnyRoles(['ceo']);
        });

        // Check if user is client
        Gate::define('client', function ($user)
        {
            return $user->hasAnyRoles(['client']);
        });

        // Check if user is head
        Gate::define('head', function ($user)
        {
            return $user->hasAnyRoles(['head']);
        });

        // Check if user is manager
        Gate::define('manager', function ($user)
        {
            return $user->hasAnyRoles(['manager']);
        });

        // Check if user is qc
        Gate::define('qc', function ($user)
        {
            return $user->hasAnyRoles(['qc']);
        });

        // Check if user is scripter
        Gate::define('scripter', function ($user)
        {
            return $user->hasAnyRoles(['scripter']);
        });

        // Check if user is supervisor
        Gate::define('supervisor', function ($user)
        {
            return $user->hasAnyRoles(['supervisor']);
        });

        // Check if user is coordinator
        Gate::define('coordinator', function ($user)
        {
            return $user->hasAnyRoles(['coordinator']);
        });
    }
}

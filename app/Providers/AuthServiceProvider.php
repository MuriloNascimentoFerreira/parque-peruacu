<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Enums\Profile;
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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->profile === Profile::USER_ADMINISTRADOR ? true : false;
        });

        Gate::define('funcionario', function ($user) {
            return $user->profile === Profile::USER_FUNCIONARIO ? true : false;
        });

        Gate::define('visitante', function ($user) {
            return $user->profile === Profile::USER_VISITANTE ? true : false;
        });
    }
}

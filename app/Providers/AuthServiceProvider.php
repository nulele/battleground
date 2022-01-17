<?php

namespace App\Providers;

use App\Models\Clan;
use App\Models\Hero;
use App\Models\User;
use Carbon\Carbon;
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

        Gate::define('show-clans', function (User $user) {
            return $user->admin;
        });

        Gate::define('edit-hero-with-attack-five', function (User $user, Hero $hero) {
            return $user->admin || $hero->attack < 5;
        });

        Gate::define('create-hero-at-even-minutes', function (User $user, $minute) {
            return $user->admin || $minute % 2 == 0;
        });
    }
}

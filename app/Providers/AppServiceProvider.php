<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Gate::define('view-admin', function (User $user) {
            return $user->is_admin
                ? Response::allow()
                : Response::denyAsNotFound();
        });
    }
}

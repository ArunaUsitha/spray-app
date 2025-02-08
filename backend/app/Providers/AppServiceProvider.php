<?php

namespace App\Providers;

use App\Repositories\Interfaces\MachineRepositoryInterface;
use App\Repositories\MachineRepository;
use App\Services\Interfaces\MachineServiceInterface;
use App\Services\MachineService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MachineRepositoryInterface::class, MachineRepository::class);
        $this->app->bind(MachineServiceInterface::class, MachineService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}

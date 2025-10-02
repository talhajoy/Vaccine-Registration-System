<?php

namespace App\Providers;

use App\Models\Registration;
use App\Policies\RegistrationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Registration::class => RegistrationPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}

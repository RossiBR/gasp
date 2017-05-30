<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Associado' => 'App\Policies\AssociadoPolicy',
        'App\Curso' => 'App\Policies\CursoPolicy',
        'App\Grade' => 'App\Policies\GradePolicy',
        'App\Local' => 'App\Policies\LocalPolicy',
        'App\Distrito' => 'App\Policies\DistritoPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

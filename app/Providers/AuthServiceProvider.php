<?php

namespace App\Providers;

use App\Models\Empresa;
use App\Policies\EmpresaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * As políticas de autorização do aplicativo.
     */
    protected $policies = [
        Empresa::class => EmpresaPolicy::class,
    ];

    /**
     * Registre quaisquer serviços de autenticação ou autorização.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}

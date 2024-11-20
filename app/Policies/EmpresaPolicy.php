<?php

namespace App\Policies;

use App\Models\Empresa;
use App\Models\User;

class EmpresaPolicy
{
    /**
     * Determine se o usuário pode atualizar a empresa.
     */
    public function update(User $user, Empresa $empresa)
    {
        // Permite a atualização se o usuário for o dono da empresa
        return $user->id === $empresa->user_id;
    }

    /**
     * Determine se o usuário pode apagar a empresa.
     */
    public function delete(User $user, Empresa $empresa)
    {
        // Permite a exclusão se o usuário for o dono da empresa
        return $user->id === $empresa->user_id;
    }

    // Outros métodos podem ser configurados conforme necessário
}

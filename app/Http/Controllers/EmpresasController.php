<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    // Listar todas as empresas do usuário autenticado
    public function index()
    {
        $empresas = auth()->user()->empresas; // Obtém apenas as empresas do usuário autenticado
        return view('empresas.index', compact('empresas'));
    }

    // Exibir formulário de criação de uma nova empresa
    public function create()
    {
        return view('empresas.create');
    }

    // Salvar uma nova empresa no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:empresas,email',
            'ativo' => 'required|boolean',
        ]);

        auth()->user()->empresas()->create($request->all());

        return redirect()->route('empresas.index')->with('success', 'Empresa criada com sucesso!');
    }

    // Exibir formulário de edição de uma empresa existente
    public function edit(Empresa $empresa)
    {
        // Garantir que a empresa pertence ao usuário autenticado
        $this->authorize('update', $empresa);

        return view('empresas.edit', compact('empresa'));
    }

    // Atualizar os dados de uma empresa no banco de dados
    public function update(Request $request, Empresa $empresa)
    {
        // Garantir que a empresa pertence ao usuário autenticado
        $this->authorize('update', $empresa);

        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:empresas,email,' . $empresa->id,
            'ativo' => 'required|boolean',
        ]);

        $empresa->update($request->all());

        return redirect()->route('empresas.index')->with('success', 'Empresa atualizada com sucesso!');
    }

    // Apagar uma empresa do banco de dados
    public function destroy(Empresa $empresa)
    {
        // Garantir que a empresa pertence ao usuário autenticado
        $this->authorize('delete', $empresa);

        $empresa->delete();

        return redirect()->route('empresas.index')->with('success', 'Empresa apagada com sucesso!');
    }
}

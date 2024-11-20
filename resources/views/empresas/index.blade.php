@extends('layouts.app')

@section('content')
    <h1>Lista de Empresas</h1>
    <a href="{{ route('empresas.create') }}" class="btn btn-primary">Nova Empresa</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empresas as $empresa)
                <tr>
                    <td>{{ $empresa->nome }}</td>
                    <td>{{ $empresa->telefone }}</td>
                    <td>{{ $empresa->email }}</td>
                    <td>{{ $empresa->ativo ? 'Sim' : 'Não' }}</td>
                    <td>
                        <a href="{{ route('empresas.edit', $empresa) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('empresas.destroy', $empresa) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Apagar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

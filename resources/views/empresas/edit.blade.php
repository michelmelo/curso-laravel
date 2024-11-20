@extends('layouts.app')

@section('content')
    <h1>Editar Empresa</h1>
    <form action="{{ route('empresas.update', $empresa) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $empresa->nome }}" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" class="form-control" value="{{ $empresa->telefone }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $empresa->email }}" required>
        </div>
        <div class="form-group">
            <label for="ativo">Ativo:</label>
            <select name="ativo" id="ativo" class="form-control" required>
                <option value="1" {{ $empresa->ativo ? 'selected' : '' }}>Sim</option>
                <option value="0" {{ !$empresa->ativo ? 'selected' : '' }}>Não</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection

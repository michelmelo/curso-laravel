@extends('layouts.app')

@section('content')
    <h1>Nova Empresa</h1>
    <form action="{{ route('empresas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ativo">Ativo:</label>
            <select name="ativo" id="ativo" class="form-control" required>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection

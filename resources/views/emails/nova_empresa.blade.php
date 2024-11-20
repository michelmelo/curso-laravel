<!DOCTYPE html>
<html>
<head>
    <title>Nova Empresa Criada</title>
</head>
<body>
    <h1>Nova Empresa Criada com Sucesso!</h1>
    <p>Olá, {{ auth()->user()->name }},</p>
    <p>Você criou a empresa <strong>{{ $empresa->nome }}</strong>.</p>
    <p><strong>Detalhes:</strong></p>
    <ul>
        <li>Telefone: {{ $empresa->telefone }}</li>
        <li>Email: {{ $empresa->email }}</li>
        <li>Status: {{ $empresa->ativo ? 'Ativo' : 'Inativo' }}</li>
    </ul>
    <p>Obrigado por usar nosso sistema!</p>
</body>
</html>

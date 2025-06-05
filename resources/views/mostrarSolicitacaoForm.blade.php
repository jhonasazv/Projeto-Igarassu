<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Solicitação</title>
</head>
<body>

    <h2>Criar Solicitação para Beneficiário</h2>

    <form method="POST" action="{{route('solicitacaoForm', ['id' => $solicitante->id]) }}">
        @csrf

        <label for="texto">Texto da Solicitação:</label><br>
        <textarea name="texto" id="texto" cols="30" rows="10"></textarea>
        
        <h3>Informações do Auxílio</h3>

        <label for="nome">Nome do Auxílio:</label><br>
        <input type="text" id="nome" name="nome" maxlength="100" value="" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" maxlength="320" required></textarea><br><br>

        <label for="valor">Valor (ex: 150.00):</label><br>
        <input type="number" id="valor" name="valor" step="0.01" min="0" value="" required><br><br>

        <label for="quantidade">Quantidade:</label><br>
        <input type="number" id="quantidade" name="quantidade" min="1" value="" required><br><br>

        <input type="submit" name="submit">
    </form>

</body>
</html>

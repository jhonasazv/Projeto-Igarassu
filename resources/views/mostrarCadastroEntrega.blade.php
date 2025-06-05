<html lang="pt-br"><head>
    <meta charset="UTF-8">
    <title>Cadastro de Entrega</title>
</head>
<body>

    <h2>Cadastro de Entrega</h2>

    <form method="POST" action="{{ route('cadastroEntrega', ['id' => $solicitacao->id]) }}">
        @csrf
        <label for="numero">Número da Entrega:</label><br>
        <input type="number" id="numero" name="numero" min="0" required=""><br><br>

        <label for="data_entrega">Data da Entrega:</label><br>
        <input type="date" id="data_entrega" name="data_entrega" required=""><br><br>

        <label for="descricao">Descrição:</label><br>
        <input type="text" id="descricao" name="descricao" maxlength="150" required=""><br><br>

        

        <button type="submit">Cadastrar Entrega</button>
    </form>



</body></html>
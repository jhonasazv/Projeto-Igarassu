<html lang="pt-br"><head>
    <meta charset="UTF-8">
    <title>Cadastro de Agendamento</title>
</head>
<body>

    <h2>Cadastro de Agendamento</h2>

    <form method="POST" action="http://localhost/projeto/prefeitura-igarassu/public/agendamento">
        @csrf
        <label for="descricao">Descrição:</label><br>
        <input type="text" id="descricao" name="descricao" maxlength="150" required=""><br><br>

        <button type="submit">Cadastrar</button>
    </form>



</body></html>
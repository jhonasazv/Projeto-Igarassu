<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Solicitação</title>
</head>
<body>
    <br>
    solicitante
    <li>nome : {{ $solicitante->nome }} - - - nis : {{ $solicitante->nis }} - - - cpf : {{ $solicitante->cpf }}
            - - - sexo : {{ $solicitante->sexo }}- - - endereco : {{ $solicitante->endereco }}  - - - usuario id : {{ $solicitante->usuario_id }} 
            </li>
    
    solicitacao
    <li>id : {{ $solicitacao->id }} - - - solicitante id : {{ $solicitacao->solicitante_id }} - - - descricao : {{ $solicitacao->texto }} - - - resultado : {{ $solicitacao->resultado }}
                - - - data deferido : {{ $solicitacao->data_deferido }}
            </li>
        assistente
        <li>id : {{ $assistente->id}} nome : {{ $assistente->name }} - - - email : {{ $assistente->email }} - - - tipo : {{ $assistente->tipo}}</li>

        <h2>Atualizar Solicitação</h2>
    <form method="POST" action="{{route('updateSolicitacao', ['id' => $solicitacao->id]) }}">
        @csrf
        @method('patch')

        <label for="data_solicitacao">Data da Solicitação:</label><br>
        <input type="date" id="data_solicitacao" name="data_solicitacao"><br><br>

        <label for="data_deferido">Data Deferido:</label><br>
        <input type="date" id="data_deferido" name="data_deferido"><br><br>

        <label for="resultado">Resultado:</label><br>
        <select id="resultado" name="resultado">
            <option value="">Selecione</option>
            <option value="1">Aprovado</option>
            <option value="0">Reprovado</option>
        </select><br><br>

        <label for="texto">Texto:</label><br>
        <textarea id="texto" name="texto" maxlength="320"></textarea><br><br>

        <label for="usuario_id">ID do Usuário:</label><br>
        <input type="number" id="usuario_id" name="usuario_id" min="1"><br><br>

        <label for="solicitacao_id">ID da Solicitação do auxilio:</label><br>
        <input type="number" id="solicitacao_id" name="solicitacao_id" min="1"><br><br>

        <label for="nome">Nome do Auxílio:</label><br>
        <input type="text" id="nome" name="nome" maxlength="100"><br><br>

        <label for="descricao">Descrição:</label><br>
        <input type="text" id="descricao" name="descricao" maxlength="100"><br><br>

        <label for="valor">Valor (ex: 100.00):</label><br>
        <input type="number" id="valor" name="valor" step="0.01" min="0"><br><br>

        <label for="quantidade">Quantidade:</label><br>
        <input type="number" id="quantidade" name="quantidade" min="1"><br><br>

        <input type="submit" name="submit">
    </form>

    <form action="{{ route('deleteSolicitacao', ['id' => $solicitacao->id]) }}" method="post">
        @csrf
        @method('delete')
        <br>
        <br>
        <input type="submit" name="submit" value="deletar">
    </form>
</body>
</html>

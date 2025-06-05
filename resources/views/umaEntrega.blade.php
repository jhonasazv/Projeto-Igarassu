<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
            solicitante
            <li>id : {{ $solicitante->id }} - - - nome : {{ $solicitante->nome }} - - - cpf : {{ $solicitante->cpf }}
                - - - nis : {{ $solicitante->nis }}
            </li>
            <br>
            solicitacao

            <li>id : {{ $solicitacao->id }} - - - descricao : {{ $solicitacao->texto }} - - - resultado : {{ $solicitacao->resultado }}
                - - - id do solicitante : {{ $solicitacao->solicitante_id }}
            </li>
            <br>
            assistente
            <li>id : {{ $assistente->id }} - - - nome : {{ $assistente->name }} - - - tipo : {{ $assistente->tipo }}
            </li>
            <br>
            entrega
            @if($entrega)
        <li>id : {{ $entrega->id}} - - - solicitacao id : {{ $entrega->solicitacao_id }} - - - data entrega : {{ $entrega->data_entrega }} - - - situacao : {{ $entrega->situacao}}
            - - - descriçao : {{ $entrega->descricao }} - - - numero : {{ $entrega->numero }}
        </li>@else
        <li>entrega nao cadastrada</li>
        @endif
            <h2>Atualizar Entrega</h2>
            
        <form method="POST" action="{{ route('updateEntrega', ['id' => $solicitacao->id]) }}">    
     

        @csrf
        <label for="numero">Número da Entrega:</label><br>
        <input type="number" id="numero" name="numero" min="0"><br><br>

        <label for="data_entrega">Data da Entrega:</label><br>
        <input type="date" id="data_entrega" name="data_entrega"><br><br>

        <label for="descricao">Descrição:</label><br>
        <input type="text" id="descricao" name="descricao"><br><br>
<br>

        <label for="solicitacao_id">ID da Solicitação:</label><br>
        <input type="number" id="solicitacao_id" name="solicitacao_id" min="1"><br><br>

        <button type="submit">Enviar</button>
    </form>
            <button><a href="{{route('mostrarCadastroEntrega', ['id' => $solicitacao->id])}}">cadastrar</a></button>
            <br>
            <br>
            <form action="{{ route('umaEntregaAutorizar', ['id' => $solicitacao->id]) }}" method="post">
                @csrf
                @method('patch')
                <input type="submit" name="submit" value="autorizar">
            </form>
            
            <form action="{{ route('deleteEntrega', ['id' => $solicitacao->id]) }}" method="post">
                @csrf
                <br>
                <br>
                <input type="submit" name="submit" value="deletar">
            </form>
           
</body>
</body>
</html>
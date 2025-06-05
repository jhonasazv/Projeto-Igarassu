<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Solicitantes
    @foreach ($solicitante as $solicitantee)
            <li>id : {{ $solicitantee->id }} - - - nome : {{ $solicitantee->nome }} - - - cpf : {{ $solicitantee->cpf }}
                - - - nis : {{ $solicitantee->nis }}
            </li>
        @endforeach
            <br>
            solicitacoes
        @foreach ($solicitacoes as $solicitacao)
            <li>id : {{ $solicitacao->id }} - - - solicitante id : {{ $solicitacao->solicitante_id }} - - - descricao : {{ $solicitacao->texto }} - - - resultado : {{ $solicitacao->resultado }}
                - - - data deferido : {{ $solicitacao->data_deferido }}
            </li>
        @endforeach
</body>
</html>
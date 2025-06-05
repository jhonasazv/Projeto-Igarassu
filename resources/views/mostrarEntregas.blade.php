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
    @foreach ($solicitantes as $solicitante)
            <li>id : {{ $solicitante->id }} - - - nome : {{ $solicitante->nome }} - - - cpf : {{ $solicitante->cpf }}
                - - - nis : {{ $solicitante->nis }}
            </li>
        @endforeach
            <br>
            solicitacoes
        @foreach ($solicitacoes as $solicitacao)
            <li>id : {{ $solicitacao->id }} - - - descricao : {{ $solicitacao->texto }} - - - resultado : {{ $solicitacao->resultado }}
                - - - id do solicitante : {{ $solicitacao->solicitante_id }}
            </li>
        @endforeach
</body>
</html>
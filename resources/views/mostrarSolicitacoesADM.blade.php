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
            <li>id : {{ $solicitacao->id }} - - - descricao : {{ $solicitacao->texto }} - - - resultado : {{ $solicitacao->resultado }}
                - - - id do solicitante : {{ $solicitacao->solicitante_id }}
            </li>
        @endforeach
        <br>
        total de solicitacoes {{$totalSolicitacoes}}<br><br>
        solicitacoes pendentes {{$Pendentes}}<br><br>
        entregas cadastradas {{$totalEntrega}}<br><br>
        solicitacoes indeferidas {{$indeferidos}}<br><br>
        solicitacoes deferidas {{$deferidos}}<br><br>
        entregas permitidas {{$entregues}}
        
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        @foreach ($agendamentos as $agendamento)
            <li>id : {{ $agendamento->id }} - - - situação : {{ $agendamento->situacao }} - - - descricao : {{ $agendamento->descricao }} - - - usuario id : {{ $agendamento->usuario_id }}
                - - - solicitante id : {{ $agendamento->solicitante_id }}
            </li>
        @endforeach
    </ul>
</body>
</html>
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
        @foreach ($solicitantes as $solicitante)
            <li>id : {{ $solicitante->id }} nome : {{ $solicitante->nome }} - - - nis : {{ $solicitante->nis }} - - - cpf : {{ $solicitante->cpf }}
            - - - sexo : {{ $solicitante->sexo }}- - - endereco : {{ $solicitante->endereco }}  - - - usuario id : {{ $solicitante->usuario_id }} 
            </li>
        @endforeach
    </ul>
</body>
</html>
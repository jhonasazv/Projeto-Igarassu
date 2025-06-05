<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
        
            <br>
            <br>
        <form action="{{ route('analiseForm', ['id' => $solicitacao->id]) }}" method="post">
        @csrf
        @method('patch')
        <br>
        <br>
        <button type="submit" name="submit" value="deferir">deferir</button><br><br>

        <button type="submit" name="submit" value="indeferir">indeferir</button>
    </form>

</body>
</html>
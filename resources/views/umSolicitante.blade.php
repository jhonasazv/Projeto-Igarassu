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
    <li> id : {{ $solicitante->id }} - - - nome : {{ $solicitante->nome }} - - - nis : {{ $solicitante->nis }} - - - cpf : {{ $solicitante->cpf }}
            - - - sexo : {{ $solicitante->sexo }}- - - endereco : {{ $solicitante->endereco }}  - - - usuario id : {{ $solicitante->usuario_id }} 
            </li>
            <br>
    <form action={{ route('updateSolicitante', ['id' => $solicitante->id]) }} method="POST">
        @csrf
        @method('patch')
        <label for="nis">nis</label><br>
        <input type="text" name="nis"><br>

        <label for="cpf">cpf</label><br>
        <input type="text" name="cpf"><br>

        <label for="nome">nome</label><br>
        <input type="text" name="nome"><br>

        <label for="sexo">sexo</label><br>
        <input type="text" name="sexo"><br>

        <label for="endereco">endereco</label><br>
        <input type="text" name="endereco"><br>

        <label for="cep">cep</label><br>
        <input type="text" name="cep"><br>

        <label for="usuario_id">usuario_id</label><br>
        <input type="text" name="usuario_id"><br>

        <input type="submit" name="submit">
    </form>

    <form action="{{ route('deleteSolicitantes', ['id' => $solicitante->id]) }}" method="post">
        @csrf
        @method('delete')
        <br>
        <br>
        <input type="submit" name="submit" value="deletar">
    </form>
    <br>
    <br>
    <button><a href="{{route('mostrarSolicitacaoForm', ['id' => $solicitante->id]) }}">cadastrar solicitacao</a></button>
    <style>
        a {
          text-decoration: none;
          color: rgb(0, 0, 0);
        }
        </style>
</body>
</html>
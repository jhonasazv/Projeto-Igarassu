<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <H2>Assistente Social</H2>

    <br>
    <h4>mostrarSolicitantes</h6>
    <button><a href="{{route('mostrarSolicitantes')}}">Exibir</a></button>
    <h4>mostrarSolicitantesForm</h6>
    <button><a href="{{route('mostrarSolicitantesForm')}}">Exibir</a></button>
    <h4>umSolicitante ---</h6>
    <button><a href="{{route('umSolicitante', ['id' => '1'])}}">Exibir</a></button>
    <br>
      <br>
      <br>
    <h4>mostrarAgendamentos</h6>
    <button><a href="{{route('mostrarAgendamentos')}}">Exibir</a></button>
    <h4>umAgendamento ---</h6>
    <button><a href="{{route('umAgendamento', ['id' => '1'])}}">Exibir</a></button>
    <br>
      <br>
      <br>
    <h4>mostrarSolicitacao</h6>
    <button><a href="{{route('mostrarSolicitacao')}}">Exibir</a></button>
    <h4>mostrarSolicitacaoForm ---</h6>
    <button><a href="{{route('mostrarSolicitacaoForm', ['id' => '1'])}}">Exibir</a></button>
    <h4>umaSolicitacao ---</h6>
    <button><a href="{{route('umaSolicitacao', ['id' => '1'])}}">Exibir</a></button>
    <br>
    <br>
    <h4>logout</h6>
      <form action="{{route('logout')}}" method="POST">
        @csrf
        @method('post')
        <button type="submit" name="submit">sair</button>
      </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <style>
        a {
          text-decoration: none;
          color: rgb(0, 0, 0);
        }
        </style>
</style>
</body>
</html>
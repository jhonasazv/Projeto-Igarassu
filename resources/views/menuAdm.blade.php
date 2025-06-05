<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <H2>Administrador</H2>
  <br>
    <h4>motrarSolicitacoesADM</h6>
    <button><a href="{{route('motrarSolicitacoesADM')}}">Exibir</a></button>
    <h4>mostrarAnalise ---</h6>
    <button><a href="{{route('mostrarAnalise' , ['id' => '1'])}}">Exibir</a></button>
    <br>
      <br>
      <br>
    <h4>mostrarEntregas</h6>
    <button><a href="{{route('mostrarEntregas')}}">Exibir</a></button>
    <h4>umaEntrega ---</h6>
    <button><a href="{{route('umaEntrega', ['id' => '3'])}}">Exibir</a></button>
      <br>
      <br>
      <br>
    <h4>mostrarUsers</h6>
    <button><a href="{{route('mostrarUsers')}}">Exibir</a></button>
    <h4>umUser ---</h6>
    <button><a href="{{route('umUser', ['id' => '1'])}}">Exibir</a></button>
    <br>
    <br>
    <h4>logout</h4>
    <form action="{{route('logout')}}" method="POST">
        @csrf
        @method('post')
        <button type="submit" name="submit">sair</button>
      </form>
      
    <style>
        a {
          text-decoration: none;
          color: rgb(0, 0, 0);
        }
        </style>
</style>
</body>
</html>
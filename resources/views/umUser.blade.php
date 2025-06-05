<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    assistentes e administradores
    <li>id : {{ $user->id}} nome : {{ $user->name }} - - - email : {{ $user->email }} - - - tipo : {{ $user->tipo}}</li>
    <br>
    <h2>Atualizar Usuario</h2>
    <form method="POST" action="{{ route('updateUsers', ['id' => $user->id]) }}">
        @method('patch')
        @csrf
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" maxlength="150"><br><br>

        <label for="name">Nome:</label><br>
        <input type="text" id="name" name="name" maxlength="150" ><br><br>

        <label for="password">Senha:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="tipo">função:</label><br>
        <select id="tipo" name="tipo">
            <option value="">Selecione</option>
            <option value="assistente">assistente</option>
            <option value="administrador">administrador</option>
        </select><br><br>

        <input type="submit">
        </form>

        <form action="{{ route('deleteUsers', ['id' => $user->id]) }}" method="post">
                @csrf
                @method("delete")
                <br>
                <br>
                <input type="submit" name="submit" value="deletar">
            </form>
</body>
</html>
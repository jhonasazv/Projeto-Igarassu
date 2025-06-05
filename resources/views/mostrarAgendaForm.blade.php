<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action= "http://localhost/projeto/prefeitura-igarassu/public/agendamento" method="POST">
        @csrf
        <label for="descricao">agenda</label><br>
        <input type="text" name="descricao"><br>

        <input type="submit" name="submit">
    </form>
</body>
</html>
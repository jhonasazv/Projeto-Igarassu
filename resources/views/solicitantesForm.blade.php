<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action= {{route('solicitantesForm')}} method="POST">
        @csrf

        <label for="nis">nis</label><br>
        <input type="text" name="nis"><br>

        <label for="cpf">cpf</label><br>
        <input type="text" name="cpf"><br>

        <label for="nome">nome</label><br>
        <input type="nome" name="nome"><br>

        <label for="sexo">sexo</label><br>
        <input type="sexo" name="sexo"><br>

        <label for="endereco">endereco</label><br>
        <input type="endereco" name="endereco"><br>

        <label for="cep">cep</label><br>
        <input type="cep" name="cep"><br>
        

        <input type="submit" name="submit">

    </form>
</body>
</html>
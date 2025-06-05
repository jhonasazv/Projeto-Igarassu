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
    agendamento
    <li>id : {{ $agendamento->id }} - - - situação : {{ $agendamento->situacao }} - - - descricao : {{ $agendamento->descricao }} - - - usuario id : {{ $agendamento->usuario_id }}
                - - - solicitante id : {{ $agendamento->solicitante_id }} - - - data agendamento : {{ $agendamento->data_agendamento }}
            </li>
            <br>
    <form action={{ route('updateAgendamento', ['id' => $agendamento->id]) }} method="POST">
        @csrf
        @method('patch')
        <label for="descricao">descricao</label><br>
        <input type="text" name="descricao"><br>

        <label for="situacao">situacao</label><br>
        <input type="text" name="situacao"><br>

        <label for="data_agendamento">data_agendamento</label><br>
        <input type="date" name="data_agendamento"><br>

        <label for="solicitante_id">solicitante_id</label><br>
        <input type="text" name="solicitante_id"><br>

        <label for="usuario_id">usuario_id</label><br>
        <input type="text" name="usuario_id"><br>

        <input type="submit" name="submit">

    </form>
    
    <form action="{{ route('deleteAgendamento', ['id' => $agendamento->id]) }}" method="post">
        @csrf
        @method('delete')
        <br>
        <br>
        <input type="submit" name="submit" value="deletar">
    </form>
</body>
</html>
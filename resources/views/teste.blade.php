<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action= "{{ route('test', ['id' => $user->id]) }}" method="POST">
        @csrf
        @method('patch')
        <label for="email">email</label><br>
        <input type="email" name="email"><br>

        <label for="name">name</label><br>
        <input type="text" name="name"><br>

        <label for="usuario_id">id</label><br>
        <input type="text" name="usuario_id"><br>

        <input type="submit" name="submit">
    </form>

    
<script>
  
</script>
</body>
</html>
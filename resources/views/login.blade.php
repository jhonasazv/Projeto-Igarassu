<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
</head>
<body>

    <h2>Login</h2>

    <form method="POST" action="{{ route('login') }}">
        <!-- CSRF Token for Laravel -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div>
            <label for="email">Email</label><br />
            <input type="email" id="email" name="email" required autofocus />
        </div>
        <br>
        <div>
            <label for="password">Password</label><br />
            <input type="password" id="password" name="password" required />
        </div>
        <br>
        <div>
            <button type="submit">Log in</button>
        </div>
    </form>

</body>
</html>
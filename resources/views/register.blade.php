<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>

    <h1>Register</h1>

    <form method="POST" action="{{ route('registerForm') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">nome</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <!-- Tipo -->
        <div>
            <label for="tipo">Tipo</label>
            <input id="tipo" name="tipo" type="text" value="{{ old('tipo') }}" required>
            @error('tipo')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required>
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password">senhna</label>
            <input id="password" name="password" type="password" required>
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required>
        </div>

        <div>
            <a href="{{ route('login') }}">Already registered?</a>
        </div>

        <div>
            <button type="submit">Register</button>
        </div>
    </form>

</body>
</html>

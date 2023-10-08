<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    <form method="get" id="register" name="register" action="{{ route('register') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('login') }}">
        @csrf
        <div>
            <label>
                Почта:
                <input type="text" name="email" placeholder="john_doe@example.com"/>
            </label>
        </div>
        <div>
            <label>
                Пароль:
                <input type="password" name="password" placeholder="********"/>
            </label>
        </div>
        <div>
            <input type="submit" name="login" value="Войти"/>
            <input type="submit" form="register" name="register" value="Регистрирация"/>
        </div>
    </form>
</div>
<br>

@if(isset($messages))
    @foreach($messages as $message)
        <div>{{ $message }}</div>
    @endforeach
@endif

</body>
</html>

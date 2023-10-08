<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
</head>
<body>

    <div>
        <form method="get" id="login" name="login" action="{{ route('login') }}">
            @csrf
        </form>
        <form method="post" action="{{ route('register') }}">
            @csrf
            <div>
                <label>
                    Никнейм:
                    <input type="text" name="name" placeholder="JohnDoe"/>
                </label>
            </div>
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
                <label>
                    Повторите пароль:
                    <input type="password" name="password_again" placeholder="********"/>
                </label>
            </div>
            <div>
                <input type="submit" value="Зарегистрировать"/>
                <input type="submit" form="login" value="Отменить регистрацию"/>
            </div>
        </form>
    </div>

    @if(isset($messages))
        @foreach($messages as $message)
            <div>{{ $message }}</div>
        @endforeach
    @endif

</body>
</html>

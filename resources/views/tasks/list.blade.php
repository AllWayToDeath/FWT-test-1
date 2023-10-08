<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
</head>
<body>
    <form method="post" action="{{ route('logout') }}">
        @csrf
        <div>
            <txt style="font-size: 30px;">{{ $user_name }}</txt>
            <input type="submit" value="Выход"/>
        </div>
    </form>
    <br>


    <div>
        <form method="post" action="{{ route('tasks.create') }}">
            @csrf
            <div>
                <input type="text" name="title" placeholder="Заголовок задания"/>
            </div>
            <div>
                <input type="textarea" name="description" placeholder="Описание задания (не обязательное)"/>
            </div>
            <div>
                <input type="submit" value="Добавить задание"/>
            </div>
        </form>
    </div>

    <hr>

    @foreach ($tasks as $task)
        <div>
            <div style="font-size: 24px;">{{ $task['title'] }}</div>
            <div style="margin-left: 40px;">{{ $task['description'] }}</div>

            <form method="post" action="{{ route('tasks.delete') }}">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task['id'] }}">
                <input type="submit" value="Удалить задание"/>
            </form>

            <hr>
        </div>
    @endforeach

</body>
</html>

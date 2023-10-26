<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - Controle de Séries</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{--a função asset faz importa o css para o projeto--}}
</head>
<body>
<div class="container">
    <h1>{{ $title }}</h1>

    @if ($errors->any())
        {{---se tiver algum erro, ele vai exibir a div abaixo--}}
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    {{--exibe todos os erros--}}
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ $slot }}
</div>
</body>
</html>


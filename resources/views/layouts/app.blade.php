<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'New App') }}</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @include('inc.navbar')
    <div class="container">
        @include("inc.messages")
        @yield('content')
    </div>

    {{-- <script>
        CKEDITOR.replace('article-ckeditor');

    </script> --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#body'))
            .catch(error => {
                console.error(error);
            });

    </script>
</body>

</html>

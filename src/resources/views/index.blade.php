<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Abraham Yusuf <aaondowasey@gmail.com>">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Todo List</title>

    <link href="{{ asset('abrahamy/todo/todo.css') }}" rel="stylesheet">
</head>

<body>

    <section class="section">
        <div id="app" class="container">
            <tasks></tasks>
        </div>
    </section>

    <!--Scripts-->
    <script type="text/javascript" src="{{ asset('abrahamy/todo/todo.js') }}"></script>
</body>

</html>


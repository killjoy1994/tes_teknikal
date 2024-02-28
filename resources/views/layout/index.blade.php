<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body {
            background-color: #f3f3f3;
        }

        .list-custom:hover {
            background-color: #f3f3f3;
            padding-left: 0;
            padding-right: 0;
        }

        .list-custom-text:hover {
            color: #0f0f0f !important;
        }

        .active {
            background-color: #f3f3f3;
            padding-left: 0;
            padding-right: 0;
        }

        .text-active {
            color: #0f0f0f !important;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    @include('include.navbar')
    <div class="container my-5">
        <div class="row">
            @include('include.sidebar')
            <div class="col-md-10">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    @stack('scripts')
</body>

</html>

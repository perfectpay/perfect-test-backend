<html lang='pt-br'>
<head>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Perfect Pay - Teste - @yield('title')</title>
    <link href="{{ asset('/images/brand/favicon.png') }}" rel="icon" type="image/png"/>
    <link rel='stylesheet' href="{{ url('/css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <style>
        .wrapper #wrapperContent, .wrapper #wrapperContent.closed {
            padding: 0;
        }
    </style>
</head>
<body>
<!-- NAVBAR TOP -->
@include('layout_header')
<div class='wrapper'>
    <div id='wrapperContent' class='content container-fluid'>
        <div id='main'>
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ url('/js/app.js') }}"></script>
<script src="https://kit.fontawesome.com/d712964458.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('js/jquery.mask.js') }}"></script>

@yield('script')
</body>
</html>

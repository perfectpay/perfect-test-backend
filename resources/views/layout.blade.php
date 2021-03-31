<html lang='pt-br'>
<head>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Perfect Pay - Teste - @yield('title')</title>
    <link href="{{ asset('/images/brand/favicon.png') }}" rel="icon" type="image/png"/>
    <link rel='stylesheet' href="{{ url('/css/app.css') }}">
    <link rel='stylesheet' href="{{ url('/css/custom.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('js/jquery.price_format.min.js')}}"></script>
<script src="{{ asset('js/jquery.mask.js')}}"></script>
<script src="{{ asset('js/funcoes.comum.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({
         headers : {'X-CSRF-TOKEN': "{{ csrf_token()}}"}
    });
</script>
@yield('script')
</body>
</html>

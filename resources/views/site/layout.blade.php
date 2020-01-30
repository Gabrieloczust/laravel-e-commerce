<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loja - @yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('site/ico/Paomedia-Small-N-Flat-Shop.ico') }}" type="image/x-icon">
</head>

<body>

    <!-- Menu -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('site') }}">Loja</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex align-items-center">
                <a href="{{ route('admin') }}">
                    <img class="icon icon1" src="{{ asset('site/svg/unauthorized-person.svg') }}" alt="Admin"
                        title="Admin">
                </a>
                <div class="button-cart ml-4 toggleCart">
                    <img class="icon icon2" src="{{ asset('site/svg/shopping-cart.svg') }}" alt="Carrinho"
                        title="Carrinho">
                    <span class="badge badge-danger">0</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- View -->
    <div class="container d-flex my-4 position-relative">
        @yield('content')
        <!-- Cart -->
        <div class="bg-dark p-4 cartOpen" id="cart">
            <button class="close toggleCart text-light" title="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            <h2 class="text-center text-light mb-4">Carrinho</h2>
            <div class="card mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="mr-4">
                        <img class="icon" src="{{ asset('site/svg/minus.svg') }}" alt="minus" title="minus"
                            style="width:25px;">
                        <img class="icon" src="{{ asset('site/svg/plus.svg') }}" alt="plus" title="plus"
                            style="width:25px;">
                    </div>
                    <div class="d-flex justify-content-between flex-grow-1">
                        <span><b>(1) </b>Produto Teste</span>
                        <span>R$ 49,99</span>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="mr-4">
                        <img class="icon" src="{{ asset('site/svg/minus.svg') }}" alt="minus" title="minus"
                            style="width:25px;">
                        <img class="icon" src="{{ asset('site/svg/plus.svg') }}" alt="plus" title="plus"
                            style="width:25px;">
                    </div>
                    <div class="d-flex justify-content-between flex-grow-1">
                        <span><b>(1) </b>Produto Teste</span>
                        <span>R$ 49,99</span>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="mr-4">
                        <img class="icon" src="{{ asset('site/svg/minus.svg') }}" alt="minus" title="minus"
                            style="width:25px;">
                        <img class="icon" src="{{ asset('site/svg/plus.svg') }}" alt="plus" title="plus"
                            style="width:25px;">
                    </div>
                    <div class="d-flex justify-content-between flex-grow-1">
                        <span><b>(1) </b>Produto Teste</span>
                        <span>R$ 49,99</span>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <b>(3) Produtos - R$ 149,97</b>
                </div>
            </div>
            <div class="card flex-row justify-content-between bg-transparent">
                <button class="btn btn-danger" style="width:49%" title="Limpar Carrinho">Limpar</button>
                <button class="btn btn-success" style="width:49%" title="FInalizar Compra">Concluir</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".toggleCart").click(function () {
                $('#cart').toggleClass('cartOpen')
                $("#cart").animate({
                    width: 'toggle'
                });
            });
        });

    </script>
</body>

</html>

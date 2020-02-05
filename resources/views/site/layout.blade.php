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
                    <span class="badge badge-danger">{{ $cartCount }}</span>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Menu -->

    <div class="container d-flex my-4 position-relative" style="min-height: 50vh">

        <!-- View -->
        @yield('content')
        <!-- End View -->

        <!-- Cart -->
        @include('site.cart')
        <!-- End Cart -->

    </div>

    <!-- Message Success -->
    @if(Session::has('success'))
        @component('components.toast')
            @slot('type') success @endslot
            @slot('title') Carrinho @endslot
            {!! Session::get('success') !!}
        @endcomponent
    @endif
    <!-- End Message Success -->

    <!-- Message Danger -->
    @if(Session::has('danger'))
        @component('components.toast')
            @slot('type') danger @endslot
            @slot('title') Carrinho @endslot
            {!! Session::get('danger') !!}
        @endcomponent
    @endif
    <!-- End Message Danger -->

    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".toggleCart").click(function () {
                $('#cart').toggleClass('cartOpen')
                $("#cart").animate({
                    width: 'toggle'
                });
            });

            $('.toast').toast('show')
        });

    </script>
</body>

</html>

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


    <div class="container d-flex my-4 position-relative" style="min-height: 50vh">

        <!-- View -->
        @yield('content')
        <!-- End View -->

        <!-- Cart -->
        <div class="bg-dark p-4 cartOpen" id="cart">
            <button class="close toggleCart text-light" title="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            <h2 class="text-center text-light mb-4">Carrinho</h2>
            @forelse ($cart as $key => $item)
            <!-- Cart Product -->
            <div class="card mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between flex-grow-1">
                        <span>
                            <b>({{ $item->product_amount }}) </b>
                            {{ $item->product_name }} - @money($item->product_price)
                        </span>
                        <b>@money($item->product_total)</b>
                    </div>
                    <div class="ml-4">
                        @if($item->product_amount > 0)
                        <a href="{{ route('cart.less', ['product' => $item->product_id]) }}"
                            title="Aumentar Quantidade">
                            <img class="icon" src="{{ asset('site/svg/minus.svg') }}" alt="minus" style="height:22px;">
                        </a>
                        @endif
                        @if($item->product_amount < $item->product_stock)
                            <a href="{{ route('cart.plus', ['product' => $item->product_id]) }}"
                                title="Diminuir Quantidade">
                                <img class="icon" src="{{ asset('site/svg/plus.svg') }}" alt="plus"
                                    style="height:22px;">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty

            @endforelse
            <!-- End Cart Product -->

            <!-- Cart Options -->
            @if($cartCount > 0)
            <div class="card mb-2">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <b>({{ $cartCount }}) {{ $cartCount > 1 ? 'Produtos' : 'Produto' }} - @money($cartTotal)</b>
                </div>
            </div>
            <div class="card flex-row justify-content-between bg-transparent">
                <form action="{{ route('cart.clear') }}" method="POST" style="width:49%">
                    @csrf
                    <input class="btn btn-danger w-100" title="Limpar Carrinho" type="submit" value="Limpar">
                </form>
                <form action="{{ route('cart.save') }}" method="POST" style="width:49%">
                    @csrf
                    <input class="btn btn-success w-100" title="Finalizar Compra" type="submit" value="Concluir">
                </form>
            </div>
            @else
            <div class="alert alert-danger text-center">
                Seu carrinho não possui nenhum produto!
            </div>
            @endif
            <!-- End Cart Options -->

        </div>
        <!-- End Cart -->

    </div>

    <!-- Message Success -->
    @if(Session::has('success'))
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true"
        style="position: absolute; top: 15px; right: 15px; z-index: 9999; min-width: 250px" data-delay="3000">
        <div class="toast-header bg-success text-light">
            <img class="rounded mr-2" style="height: 15px" src="{{ asset('site/svg/shopping-cart.svg') }}"
                alt="Carrinho" title="Carrinho">
            <strong class="mr-auto">Carrinho</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body py-3">
            {!! Session::get('success') !!}
        </div>
    </div>
    @endif
    <!-- End Message Success -->

    <!-- Message Danger -->
    @if(Session::has('danger'))
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true"
        style="position: absolute; top: 15px; right: 15px; z-index: 9999; min-width: 250px" data-delay="3000">
        <div class="toast-header bg-danger text-light">
            <img class="rounded mr-2" style="height: 15px" src="{{ asset('site/svg/shopping-cart.svg') }}"
                alt="Carrinho" title="Carrinho">
            <strong class="mr-auto">Carrinho</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body py-3">
            {!! Session::get('danger') !!}
        </div>
    </div>
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

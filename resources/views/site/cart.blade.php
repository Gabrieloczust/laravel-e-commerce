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

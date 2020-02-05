<div class="toast" role="alert" aria-live="assertive" aria-atomic="true"
    style="position: absolute; top: 15px; right: 15px; z-index: 9999; min-width: 250px" data-delay="3000">
    <div class="toast-header bg-{{ $type }} text-light">
        <img class="rounded mr-2" style="height: 15px" src="{{ asset('site/svg/shopping-cart.svg') }}" alt="Carrinho"
            title="Carrinho">
        <strong class="mr-auto">{{ $title }}</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body py-3">
       {!! $slot !!}
    </div>
</div>

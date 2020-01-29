@extends('adminlte::page')

@section('title', "Produtos da Categoria $category->name")

@section('content_header')
<div class="row">
    <div class="col-sm-6 d-flex align-items-center">
        @if($category->photo)
        <img class="img-thumbnail rounded mr-4 d-block" style="width:80px" src="{{ Storage::url($category->photo) }}"
            alt="Foto Categoria">
        @endif
        <h1>Produtos da Categoria {{ $category->name }}</h1>
    </div>
    <div class="col-sm-6 d-flex align-items-center justify-content-end">
        <a href="{{ route('categories.index') }}" class="btn btn-md btn-secondary mr-2">
            Voltar
        </a>
        <a href="{{ route('products.create', ['category' => $category->id]) }}" class="btn btn-md btn-primary">
            Cadastar {{ $category->name }}
        </a>
    </div>
</div>
@stop

@section('content')

@if(session('warning'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <div><i class="icon fa fa-check-circle"></i> {!! session('warning') !!}</div>
</div>
@endif

<div class="row">
    @forelse($products as $product)
    <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4">
        <div class="card h-100">
            <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 180px;">
                @if($product->photo)
                    <img src="{{ Storage::url($product->photo) }}" alt="Foto do Produto" class="img-fluid" style="max-height:100%">
                @else
                    <span class="text-danger">Produto sem Foto</span>
                @endif
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
                <h6 class="card-title d-flex justify-content-between">
                    <span>{{ $product->name }}</span>
                    <span class="text-nowrap">{{ $product->getPrice() }}</span>
                </h6>
                <p class="card-text">{{ $product->description }}</p>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                        class="btn btn-info mr-2">Editar</a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#modelDelete"
                        data-route="{{ route('products.destroy', ['product' => $product->id]) }}">Apagar</button>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-warning mb-0 w-100" role="alert">
        Nenhum produto possui esta categoria <i class="far fa-frown"></i>
        <a href="{{ route('products.create', ['category' => $category->id]) }}" class="alert-link">Cadastar Agora!</a>
    </div>
    @endforelse
</div>

<!-- Modal -->
<div class="modal fade" id="modelDelete" tabindex="-1" role="dialog" aria-labelledby="modelDeleteLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelDeleteLabel">Tem Certeza?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="" method="POST" class="d-inline" id="formModal">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="Apagar" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    $(document).ready(function () {
        // Modal
        $('[data-toggle="modal"]').click(function () {
            let action = $(this).attr('data-route')
            $('#formModal').attr('action', action)
        })
    });

</script>
@endsection

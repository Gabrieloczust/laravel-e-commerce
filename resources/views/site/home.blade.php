@extends('site.layout')

@section('title', 'Home')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="d-md-flex justify-content-between align-items-center m-0">
            <span>Produtos <span class="badge badge-primary">{{ $countProducts }}</span></span>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar produto..." name="search" required>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </h1>
    </div>
    <div class="card-header">
        <form class="nav nav-tabs card-header-tabs">
            <div class="nav-item">
                <button name="category" value="all" class="nav-link {{ $existCategory != false ?: 'active' }}">
                    Todos
                </button>
            </div>
            @foreach($categories as $category)
            <div class="nav-item">
                <button name="category" value="{{ $category->id }}"
                    class="nav-link {{ $filterCategory != $category->id ?: 'active' }}">
                    {{ $category->name }}
                </button>
            </div>
            @endforeach
        </form>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($products as $product)
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
                        @if($search)
                            <h6 class="card-subtitle mb-2 text-muted">
                                {{ $product->category()->first()->name }}
                            </h6>
                        @endif
                        <p class="card-text">{{ $product->description }}</p>
                        <a href="#" title="Comprar" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            @endforeach
            @if($warning)
                <div class="alert alert-warning col text-center mb-0">
                    {!! $warning !!}
                </div>
            @endif
        </div>
    </div>
</div>
@stop

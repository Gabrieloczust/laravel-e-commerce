@extends('adminlte::page')

@section('title', 'Novo Produto')

@section('content_header')
<div class="row">
    <div class="col-sm-6">
        <h1>Novo Produto</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Lista de Produtos</a></li>
            <li class="breadcrumb-item active">Novo Produto</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="card">
    @if ($errors->any())
    <div class="card-header">
        <div class="alert alert-danger mb-0 alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="card-body">
        @if(count($categories) > 0)
        <form action="{{ route('products.store') }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autofocus
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label">Categoria</label>
                <div class="col-sm-10">
                    <select id="category" name="category_id" class="form-control" required>
                        @if(count($categories) > 1)
                        <option selected disabled value="">Escolher...</option>
                        @endif
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') != $category->id ?: 'selected' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Preço</label>
                <div class="col-sm-10">
                    <input type="number" step="any" min="0.01" class="form-control" id="price" name="price"
                        value="{{ old('price') }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="stock" class="col-sm-2 col-form-label">Estoque</label>
                <div class="col-sm-10">
                    <input type="number" min="0" class="form-control" id="stock" name="stock" value="{{ old('stock') }}"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Descrição</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" rows="5"
                        name="description">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" id="photo" name="photo">
                    <div class="d-flex">
                        <div id="capa" style="display:none">
                            <img alt="Nova Foto" class="img-thumbnail rounded d-block mt-3" style="height:200px">
                            <figcaption class="figure-caption text-success text-center mt-2 w-100">Nova Foto</span>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
        </form>
        @else
        <div class="alert alert-warning mb-0" role="alert">
            Necessário ao menos uma categoria para cadastar um produto! <i class="far fa-frown"></i>
            <a href="{{ route('categories.create') }}" class="alert-link">Cadastar categoria Agora!</a>
        </div>
        @endif
    </div>
</div>
@stop

@section('js')
<script>
    let input = $('#photo');
    let div = $('#capa');
    let img = $('#capa img');
    input.change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                img.attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
        div.fadeIn(500);
    });
</script>
@endsection

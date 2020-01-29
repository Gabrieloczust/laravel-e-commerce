@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content_header')
<div class="row">
    <div class="col-sm-6">
        <h1>Editar Produto</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Lista de Produtos</a></li>
            <li class="breadcrumb-item active">Editar Produto</li>
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
        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" class="form" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label">Categoria</label>
                <div class="col-sm-10">
                    <select id="category" name="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected
                            @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Preço</label>
                <div class="col-sm-10">
                    <input type="number" step="any" min="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="stock" class="col-sm-2 col-form-label">Estoque</label>
                <div class="col-sm-10">
                    <input type="number" min="0" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Descrição</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" rows="5"
                        name="description">{{ $product->description }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" id="photo" name="photo">
                    <div class="d-flex">
                        @if($product->photo)
                        <div class="mr-4" id="old">
                            <img src="{{ Storage::url($product->photo) }}" alt="Foto Atual" class="img-thumbnail rounded d-block mt-3" style="height:200px" >
                            <figcaption class="figure-caption text-center mt-2 w-100">Foto Atual</span>
                        </div>
                        @endif
                        <div id="capa" style="display:none">
                            <img alt="Nova Foto" class="img-thumbnail rounded d-block mt-3" style="height:200px" >
                            <figcaption class="figure-caption text-success text-center mt-2 w-100">Nova Foto</span>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right">Salvar</button>
        </form>
    </div>
</div>
@stop

@section('js')
<script>
    let input = $('#photo');
    let div = $('#capa');
    let captionOld = $('#old figcaption');
    let img = $('#capa img');
    input.change(function () {        
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                img.attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
        captionOld.addClass('text-danger');
        div.fadeIn(500);
    });
</script>
@endsection

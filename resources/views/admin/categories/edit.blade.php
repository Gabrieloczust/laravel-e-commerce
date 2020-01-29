@extends('adminlte::page')

@section('title', 'Editar Categoria')

@section('content_header')
<div class="row">
    <div class="col-sm-6">
        <h1>Editar Categoria</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Lista de Categorias</a></li>
            <li class="breadcrumb-item active">Editar Categoria</li>
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
        <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST" class="form"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name') ? old('name') : $category->name }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="photo" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" id="photo" name="photo">
                    <div class="d-flex">
                        @if($category->photo)
                        <div class="mr-4" id="old">
                            <img src="{{ Storage::url($category->photo) }}" alt="Foto Atual" class="img-thumbnail rounded d-block mt-3" style="height:200px" >
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

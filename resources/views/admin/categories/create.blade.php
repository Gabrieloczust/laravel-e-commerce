@extends('adminlte::page')

@section('title', 'Nova Categoria')

@section('content_header')
<div class="row">
    <div class="col-sm-6">
        <h1>Nova Categoria</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Lista de Categorias</a></li>
            <li class="breadcrumb-item active">Nova Categoria</li>
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
        <form class="form" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autofocus
                        required>
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

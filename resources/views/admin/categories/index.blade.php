@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Categorias')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Categorias</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-md btn-primary">Nova Categoria</a>
</div>
@stop

@section('content')

@if(session('warning'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <div><i class="icon fa fa-check-circle"></i> {!! session('warning') !!}</div>
</div>
@endif

<div class="card">
    <div class="card-body">
        @if (count($categories) > 0)
        <table class="table table-striped table-bordered" data-order='[[ 0, "desc" ]]'>
            <thead class="">
                <tr class="text-bold">
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cadastrado em</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}.</th>
                    <td>
                        @if(!$category->photo)
                            {{ $category->name }}
                        @else
                            <img src="{{ Storage::url($category->photo) }}" alt="Foto Categoria"
                            style="max-height:40px; max-width: 50px" class="m-auto d-block">
                            <small class="text-muted font-weight-lighter">{{ $category->name }}</small>
                        @endif
                    </td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                            class="btn btn-info btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modelDelete" data-route="{{ route('categories.destroy', ['category' => $category->id]) }}">Apagar</button>
                        <a href="{{ route('categories.show', ['category' => $category->id]) }}"
                            class="btn btn-success btn-sm">
                            Produtos <span class="badge bg-light">{{ count($category->product()->get()) }}</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @else
        <div class="alert alert-warning mb-0" role="alert">
            Nenhuma categoria cadastrada <i class="far fa-frown"></i>
            <a href="{{ route('categories.create') }}" class="alert-link">Cadastar Agora!</a>
        </div>
        @endif
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modelDelete" tabindex="-1" role="dialog" aria-labelledby="modelDeleteLabel" aria-hidden="true">
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

@endsection

@section('js')
<script>
    $(document).ready(function () {
        // Table
        $('table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            }
        });

        // Modal
        $('[data-toggle="modal"]').click(function(){
            let action = $(this).attr('data-route')
            $('#formModal').attr('action', action)
        })
    });
</script>
@endsection

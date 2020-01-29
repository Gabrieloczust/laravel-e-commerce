@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Produtos')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Produtos</h1>
    <a href="{{ route('products.create') }}" class="btn btn-md btn-primary">Novo Produto</a>
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
        @if (count($products) > 0)
        <table class="table table-striped table-bordered" data-order='[[ 0, "desc" ]]'>
            <thead class="">
                <tr class="text-bold">
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Estoque</th>
                    <th scope="col">Cadastrado em</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}.</th>
                    <td>
                        @if(!$product->photo)
                            {{ $product->name }}
                        @else
                            <img src="{{ Storage::url($product->photo) }}" alt="Foto Produto"
                            style="max-height:40px; max-width: 50px" class="m-auto d-block">
                            <small class="text-muted font-weight-lighter">{{ $product->name }}</small>
                        @endif
                    </td>
                    <td>{{ $product->getPrice() }}</td>
                    <td>
                        @if(!$product->category()->first()->photo)
                            {{ $product->category()->first()->name }}
                        @else
                            <img src="{{ Storage::url($product->category()->first()->photo) }}" alt="Foto Categoria"
                            style="max-height:40px; max-width: 50px" class="m-auto d-block">
                            <small class="text-muted font-weight-lighter">{{ $product->category()->first()->name }}</small>
                        @endif
                    </td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                            class="btn btn-info btn-sm">Editar</a>
                        <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST"
                            class="d-inline">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Apagar" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @else
        <div class="alert alert-warning mb-0" role="alert">
            Nenhum produto cadastrado <i class="far fa-frown"></i>
            <a href="{{ route('products.create') }}" class="alert-link">Cadastar Agora!</a>
        </div>
        @endif
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('table').DataTable({
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Todos"]
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            }
        });
    });

</script>
@endsection

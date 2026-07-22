@extends('layouts.argon')

@section('content')
    <div class="card mb-4">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-1">Fabricantes e Produtos</h5>
                <p class="text-sm mb-0 text-muted">Gerencie a lista de fabricantes e produtos os quais são vendidos no dia a dia.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="#" class="btn btn-outline-primary btn-sm mb-0 text-bold" data-bs-toggle="modal" data-bs-target="#modalManufacturer">
                    <i class="fa-solid fa-industry me-1"></i> Cadastrar Fabricante
                </a>
                <a href="#" class="btn btn-primary btn-sm mb-0 text-bold" data-bs-toggle="modal" data-bs-target="#modalProduct">
                    <i class="fa-solid fa-plus me-1"></i> Cadastrar Produto
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">

                    </div>

                    <div class="col-12 col-lg-4">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalManufacturer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Novo fabricante</h5>
                </div>
                <form action="{{ route('fabricantes-e-produtos.store') }}" method="post">
                    @csrf
                <div class="modal-body">
                        <label for="fabricante" class="text-sm">Fabricante</label>
                        <input type="text" class="form-control" id="fabricante" name="manufacturer">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Novo produto</h5>
                </div>
                <form action="{{ route('fabricantes-e-produtos.store') }}" method="post">
                    @csrf
                <div class="modal-body">
                    <label for="fabricante" class="text-sm">Fabricante</label>
                    <select name="prodManufacturer" id="fabricante" class="form-select cursor-pointer">
                        <option disabled selected>Selecione</option>
                    </select>
                    <label for="produto" class="text-sm mt-3">Produto</label>
                    <input type="text" class="form-control" id="produto" name="product">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

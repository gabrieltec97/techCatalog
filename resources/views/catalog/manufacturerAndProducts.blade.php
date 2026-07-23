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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Fabricante</th>
                                <th scope="col">Produto</th>
                                <th scope="col">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    @foreach($manufacturers as $manufacturer)
                                        @if($manufacturer->id == $product->manufacturer_id)
                                            <td>{{ $manufacturer->name }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <a class="text-primary me-2 cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalEditProd{{$product->id}}" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- Botão Excluir -->
                                        <a class="text-danger cursor-pointer" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#modalDeleteProd{{$product->id}}" title="Excluir">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modalEditProd{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edição de produto</h5>
                                            </div>
                                            <form action="{{ route('fabricantes-e-produtos.update', $product->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <label for="fabricante" class="text-sm">Fabricante</label>
                                                    <select name="prodManufacturer" id="fabricante" class="form-select cursor-pointer">
                                                        <option disabled selected>Selecione</option>
                                                        @foreach($manufacturers as $manufacturer)
                                                            <option value="{{ $manufacturer->id }}" @selected($product->manufacturer_id == $manufacturer->id)>
                                                                {{ $manufacturer->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="produto" class="text-sm mt-3">Produto</label>
                                                    <input type="text" class="form-control" id="produto" name="product" value="{{ $product->name }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                    @csrf
                                    <div class="modal fade" id="modalDeleteProd{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Deletar produto</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="color: black">Deseja deletar <b>{{ $product->name }}</b> ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12 col-lg-4">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Fabricantes</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($manufacturers as $manufacturer)
                                <tr>
                                    <td>{{ $manufacturer->name }}</td>
                                    <td>
                                        <a class="text-primary me-2 cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalEditManuf{{$manufacturer->id}}" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- Botão Excluir -->
                                        <a class="text-danger cursor-pointer" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#modalDeleteManuf{{$manufacturer->id}}" title="Excluir">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modalEditManuf{{ $manufacturer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Novo fabricante</h5>
                                            </div>
                                            <form action="{{ route('fabricantes-e-produtos.update', $manufacturer->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <label for="fabricante" class="text-sm">Fabricante</label>
                                                    <input type="text" class="form-control" id="fabricante" name="manufacturer" value="{{ $manufacturer->name }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('fabricantes-e-produtos.destroy', $manufacturer->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal fade" id="modalDeleteManuf{{$manufacturer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Deletar produto</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="color: black">Deseja deletar <b>{{ $manufacturer->name }}</b> ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
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
                        @foreach($manufacturers as $manufacturer)
                            <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                        @endforeach
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

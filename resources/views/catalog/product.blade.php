@extends('layouts.argon')

@section('content')
    <div class="card mb-4">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <a href="{{ route('catalogo.index') }}" class="btn btn-outline-secondary btn-sm mb-0 me-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Voltar
                </a>
                <div>
                    <h5 class="mb-0">{{ $product->title }}</h5>
                    <span class="text-xs text-muted">IMEI/Série: {{ $product->imei ?? 'Não cadastrado' }}</span>
                </div>
            </div>
            <div>
                <a href="{{ route('catalogo.edit', $product->id) }}" class="btn btn-warning btn-sm mb-0 me-2">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Editar
                </a>
                <form action="{{ route('catalogo.destroy', $product->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm mb-0">
                        <i class="fa-solid fa-trash me-1"></i> Excluir
                    </button>
                </form>
                <a href="#" class="btn btn-success btn-sm mb-0 me-2">
                    <i class="fa-solid fa-cart-shopping me-1"></i> Realizar Venda
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-4 overflow-hidden">
        <div class="card-body p-4 bg-light">
            @if (!empty($product->images) && count($product->images) > 0)
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    @if(count($product->images) > 1)
                        <div class="carousel-indicators">
                            @foreach ($product->images as $index => $image)
                                <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                    @endif

                    <div class="carousel-inner rounded-3 bg-white shadow-sm">
                        @foreach ($product->images as $index => $image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }} text-center p-4">
                                <img src="{{ Storage::url($image) }}" class="img-fluid rounded" alt="{{ $product->title }}" style="max-height: 400px; object-fit: contain;">
                            </div>
                        @endforeach
                    </div>

                    @if(count($product->images) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark border-radius-md p-3" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark border-radius-md p-3" aria-hidden="true"></span>
                            <span class="visually-hidden">Próximo</span>
                        </button>
                    @endif
                </div>
            @else
                <div class="text-center p-5 bg-white rounded shadow-sm">
                    <i class="fa-solid fa-image text-secondary fa-3x mb-3 opacity-5"></i>
                    <p class="text-muted mb-0">Nenhuma imagem cadastrada para este produto.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- SESSÃO 2 -->
    <div class="card mb-4">
        <div class="card-header pb-0 border-bottom">
            <h6 class="mb-3 font-weight-bold">Especificações e Detalhes do Produto</h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                <!-- Bloco 1 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="border p-3 border-radius-lg h-100 bg-gray-100">
                        <span class="text-uppercase text-xs font-weight-bolder text-primary d-block mb-2">
                            <i class="fa-solid fa-mobile-screen me-1"></i> Dispositivo
                        </span>
                        <ul class="list-unstyled text-sm mb-0">
                            <li class="mb-1"><strong>Fabricante:</strong> {{ $product->manufacturer }}</li>
                            <li class="mb-1"><strong>Modelo:</strong> {{ $product->model }}</li>
                            <li class="mb-1"><strong>Tipo:</strong> {{ $product->device }}</li>
                            <li class="mb-1"><strong>Armazenamento:</strong> {{ $product->storage ?? 'N/A' }}</li>
                            <li><strong>Memória RAM:</strong> {{ $product->ram ?? 'N/A' }}</li>
                        </ul>
                    </div>
                </div>

                <!-- Bloco 2-->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="border p-3 border-radius-lg h-100 bg-gray-100">
                        <span class="text-uppercase text-xs font-weight-bolder text-warning d-block mb-2">
                            <i class="fa-solid fa-shield-halved me-1"></i> Estado & Saúde
                        </span>
                        <ul class="list-unstyled text-sm mb-0">
                            <li class="mb-1">
                                <strong>Condição:</strong>
                                <span class="badge badge-sm {{ $product->condition == 'Novo' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $product->condition }}
                                </span>
                            </li>
                            <li class="mb-1"><strong>Grau Estético:</strong> {{ $product->grade ?? 'N/A' }}</li>
                            <li class="mb-1"><strong>Saúde Bateria:</strong> {{ $product->battery ? $product->battery . '%' : 'N/A' }}</li>
                            <li class="mb-1"><strong>Cor:</strong> {{ $product->color ?? 'N/A' }}</li>
                            <li><strong>Conta Vinculada:</strong> {{ $product->account_status }}</li>
                        </ul>
                    </div>
                </div>

                <!-- Bloco 3: -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="border p-3 border-radius-lg h-100 bg-gray-100">
                        <span class="text-uppercase text-xs font-weight-bolder text-info d-block mb-2">
                            <i class="fa-solid fa-wrench me-1"></i> Histórico & Garantia
                        </span>
                        <ul class="list-unstyled text-sm mb-0">
                            <li class="mb-1"><strong>Garantia:</strong> {{ $product->guarantee ?? 'Sem informação' }}</li>
                            <li class="mb-1"><strong>Reparos:</strong> {{ $product->repairs ?? 'Sem histórico' }}</li>
                            <li class="mb-1"><strong>Acessórios:</strong> {{ $product->accessories ?? 'Nenhum' }}</li>
                            <li><strong>IMEI:</strong> {{ $product->imei ?? 'N/A' }}</li>
                        </ul>
                    </div>
                </div>

                <!-- Bloco 4 -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="border p-3 border-radius-lg h-100 bg-gray-100">
                        <span class="text-uppercase text-xs font-weight-bolder text-success d-block mb-2">
                            <i class="fa-solid fa-sack-dollar me-1"></i> Comercial
                        </span>
                        <ul class="list-unstyled text-sm mb-0">
                            <li class="mb-2">
                                <span class="d-block text-xs text-muted">Preço de Venda</span>
                                <span class="h5 font-weight-bold text-success mb-0">R$ {{ number_format($product->selling_price, 2, ',', '.') }}</span>
                            </li>
                            @if($product->cost_price)
                                <li class="mb-1">
                                    <small class="text-muted">Preço de Custo:</small>
                                    <span>R$ {{ number_format($product->cost_price, 2, ',', '.') }}</span>
                                </li>
                            @endif
                            <li><strong>Estoque Atual:</strong> {{ $product->quantity }} unid.</li>
                        </ul>
                    </div>
                </div>

                <!-- Descrição Adicional / Observações -->
                @if($product->description)
                    <div class="col-12 mt-4">
                        <div class="border p-3 border-radius-lg bg-white">
                            <span class="text-uppercase text-xs font-weight-bolder text-secondary d-block mb-2">
                                <i class="fa-solid fa-align-left me-1"></i> Descrição / Observações
                            </span>
                            <p class="text-sm mb-0 text-dark" style="white-space: pre-line;">{{ $product->description }}</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

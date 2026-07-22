@extends('layouts.argon')

@section('content')
    <div class="card mb-4">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-1">Catálogo de Produtos</h5>
                <p class="text-sm mb-0 text-muted">Gerencie e visualize todos os dispositivos cadastrados no seu estoque.</p>
            </div>
            <a href="{{ route('catalogo.create') }}" class="btn btn-primary btn-sm mb-0 font-weight-bold">
                <i class="fa-solid fa-plus me-1"></i> Novo Cadastro
            </a>
        </div>
    </div>

    <div class="row">
        @forelse ($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-4">
                <div class="card h-100 shadow-sm border-0 overflow-hidden">

                    <div class="position-relative text-center bg-light p-3">
                        @if (!empty($product->images) && count($product->images) > 0)
                            <img src="{{ Storage::url($product->images[0]) }}"
                                 class="card-img-top img-fluid"
                                 alt="{{ $product->title }}"
                                 style="height: 180px; object-fit: contain;">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=Sem+Foto"
                                 class="card-img-top img-fluid opacity-6"
                                 alt="Sem Imagem"
                                 style="height: 180px; object-fit: contain;">
                        @endif

                        <span class="badge position-absolute top-0 start-0 m-3 {{ $product->condition == 'Novo' ? 'bg-success' : 'bg-warning' }}">
                            {{ $product->condition }}
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between p-3">
                        <div>
                            <span class="text-uppercase text-xs font-weight-bolder text-muted d-block mb-1">
                                {{ $product->manufacturer->name ?? $product->manufacturer ?? 'N/A' }} • {{ $product->storage ?? 'N/A' }}
                            </span>

                            <h6 class="card-title font-weight-bold mb-2 text-truncate" title="{{ $product->title }}">
                                {{ $product->title }}
                            </h6>

                            {{-- Exibição dinâmica de Bateria e Condição Estética --}}
                            <div class="text-xs text-muted mb-3">
                                {{-- Exibe Bateria (100% se for Novo e não for Fone/Acessório, ou % do banco se cadastrado) --}}
                                @if($product->condition === 'Novo' && !in_array($product->device, ['Fone', 'Acessório']))
                                    <span class="me-2"><i class="fa-solid fa-battery-full text-success me-1"></i> 100%</span>
                                @elseif($product->battery)
                                    <span class="me-2"><i class="fa-solid fa-battery-half text-success me-1"></i> {{ $product->battery }}%</span>
                                @endif

                                {{-- Exibe Status Estético (Lacrado se for Novo, ou Grau se cadastrado) --}}
                                @if($product->condition === 'Novo')
                                    <span><i class="fa-solid fa-star text-warning me-1"></i> Lacrado</span>
                                @elseif($product->grade)
                                    <span><i class="fa-solid fa-star text-warning me-1"></i> {{ $product->grade }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="pt-2 border-top d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-xxs text-muted d-block">Preço</small>
                                <span class="text-sm font-weight-bolder text-dark">
                                    R$ {{ number_format($product->selling_price, 2, ',', '.') }}
                                </span>
                            </div>

                            <a href="{{ route('catalogo.show', $product->id) }}" class="btn btn-outline-primary btn-sm mb-0 px-3">
                                Detalhes
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card text-center p-5">
                    <div class="card-body">
                        <i class="fa-solid fa-boxes-packing text-secondary fa-3x mb-3 opacity-6"></i>
                        <h5>Nenhum produto cadastrado!</h5>
                        <p class="text-muted text-sm">Seu catálogo ainda está vazio. Comece adicionando o seu primeiro dispositivo.</p>
                        <a href="{{ route('catalogo.create') }}" class="btn btn-primary btn-sm mt-2">
                            Cadastrar Primeiro Produto
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection

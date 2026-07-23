@extends('layouts.argon')

@section('content')
    <style>
        .field-animate {
            transition: opacity 0.25s ease, transform 0.25s ease;
            opacity: 1;
            transform: translateY(0);
        }
        .field-animate.field-fading {
            opacity: 0;
            transform: translateY(-6px);
        }
        .field-animate.field-hidden {
            display: none !important;
        }
    </style>

    <div class="card mb-4">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-1">Editar Produto</h5>
                <p class="text-sm mb-0 text-muted">Atualize as informações do item no estoque.</p>
            </div>
            <a href="{{ route('catalogo.index') }}" class="btn btn-primary btn-sm mb-0 text-bold">Voltar ao Catálogo</a>
        </div>
    </div>

    <form action="{{ route('catalogo.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-header pb-2">
                <h6 class="mb-0">1. Informações Básicas</h6>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="title" class="form-label">Título do Anúncio</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $product->title) }}" placeholder="Ex: iPhone 13 Pro Max 256GB Grafite" required>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="device" class="form-label">Tipo de Dispositivo</label>
                        <select name="device" id="device" class="form-select cursor-pointer" required>
                            <option value="" disabled>Selecione o dispositivo</option>
                            @foreach(['Celular' => 'Celular / Smartphone', 'Tablet' => 'Tablet / iPad', 'Smartwatch' => 'Smartwatch', 'Fone' => 'Fone / Headphone', 'Acessório' => 'Acessório / Carregador'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('device', $product->device) == $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Fabricante --}}
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="manufacturer_id" class="form-label">Fabricante / Marca</label>
                        <select name="manufacturer_id" id="manufacturer_id" class="form-select cursor-pointer" required>
                            <option value="" disabled>Selecione o fabricante</option>
                            @foreach($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->id }}" @selected(old('manufacturer_id', $product->manufacturer_id) == $manufacturer->id)>
                                    {{ $manufacturer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Modelo --}}
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="working_product_id" class="form-label">Modelo</label>
                        <select name="device_model_id" id="working_product_id" class="form-select cursor-pointer" required>
                            <option value="" disabled>Carregando modelo...</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3 field-animate" id="wrapper-storage">
                        <label for="storage" class="form-label">Armazenamento Interno</label>
                        <select name="storage" id="storage" class="form-select cursor-pointer">
                            <option value="" disabled selected>Selecione a capacidade</option>
                            @foreach(['32GB', '64GB', '128GB', '256GB', '512GB', '1TB', '2TB'] as $size)
                                <option value="{{ $size }}" @selected(old('storage', $product->storage) == $size)>{{ $size }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3 field-animate" id="wrapper-ram">
                        <label for="ram" class="form-label">Memória RAM</label>
                        <select name="ram" id="ram" class="form-select cursor-pointer">
                            <option value="" disabled selected>Selecione a memória RAM</option>
                            @foreach(['3GB', '4GB', '6GB', '8GB', '12GB', '16GB'] as $ramSize)
                                <option value="{{ $ramSize }}" @selected(old('ram', $product->ram) == $ramSize)>{{ $ramSize }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header pb-2">
                <h6 class="mb-0">2. Condição e Conservação</h6>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <label for="condition" class="form-label">Condição do Aparelho</label>
                        <select name="condition" id="condition" class="form-select cursor-pointer" required>
                            <option value="" disabled>Selecione a condição</option>
                            @foreach(['Novo' => 'Novo (Lacrado)', 'Seminovo' => 'Seminovo', 'Recondicionado' => 'Recondicionado (Refurbished)', 'Usado' => 'Usado', 'Sucata' => 'Sucata / Para Peças'] as $condVal => $condLabel)
                                <option value="{{ $condVal }}" @selected(old('condition', $product->condition) == $condVal)>{{ $condLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3 field-animate" id="wrapper-grade">
                        <label for="grade" class="form-label">Grau Estético</label>
                        <select name="grade" id="grade" class="form-select cursor-pointer">
                            <option value="" selected disabled>Selecione a condição estética</option>
                            <optgroup label="Novos">
                                <option value="Novo Lacrado" @selected(old('grade', $product->grade) == 'Novo Lacrado')>Novo (Lacrado na Caixa)</option>
                                <option value="Novo de Vitrine / Open Box" @selected(old('grade', $product->grade) == 'Novo de Vitrine / Open Box')>Novo de Vitrine / Open Box</option>
                            </optgroup>
                            <optgroup label="Seminovos / Usados">
                                <option value="Grau A+ (Impecável, sem marcas)" @selected(old('grade', $product->grade) == 'Grau A+ (Impecável, sem marcas)')>Grau A+ (Impecável, sem marcas)</option>
                                <option value="Grau A (Marcas mínimas de uso)" @selected(old('grade', $product->grade) == 'Grau A (Marcas mínimas de uso)')>Grau A (Marcas mínimas de uso)</option>
                                <option value="Grau B (Marcas leves/riscos discretos)" @selected(old('grade', $product->grade) == 'Grau B (Marcas leves/riscos discretos)')>Grau B (Marcas leves/riscos discretos)</option>
                                <option value="Grau C (Marcado/Sinais visíveis)" @selected(old('grade', $product->grade) == 'Grau C (Marcado/Sinais visíveis)')>Grau C (Marcado/Sinais visíveis)</option>
                            </optgroup>
                            <optgroup label="Com Detalhes">
                                <option value="Tela com riscos visíveis" @selected(old('grade', $product->grade) == 'Tela com riscos visíveis')>Tela com riscos visíveis</option>
                                <option value="Carcaça amassada/trincada" @selected(old('grade', $product->grade) == 'Carcaça amassada/trincada')>Carcaça amassada/trincada</option>
                                <option value="Para Retirada de Peças" @selected(old('grade', $product->grade) == 'Para Retirada de Peças')>Para Retirada de Peças</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3 field-animate" id="wrapper-battery">
                        <label for="battery" class="form-label">Saúde da Bateria (%)</label>
                        <div class="input-group">
                            <input type="number" min="0" max="100" id="battery" name="battery" class="form-control" value="{{ old('battery', $product->battery) }}" placeholder="Ex: 88">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3 field-animate" id="wrapper-color">
                        <label for="color" class="form-label">Cor</label>
                        <select name="color" id="color" class="form-select cursor-pointer">
                            <option value="" selected disabled>Selecione a cor</option>
                            @foreach(['Preto', 'Branco', 'Cinza', 'Prata', 'Grafite', 'Dourado', 'Azul', 'Vermelho', 'Verde', 'Amarelo', 'Roxo / Violeta', 'Rosa', 'Laranja', 'Azul Sierra / Pacífico', 'Verde Alpino / Oliva', 'Roxo Profundo', 'Titânio Natural', 'Titânio Preto', 'Titânio Branco', 'Titânio Azul', 'Titânio Deserto', 'Estelar (Starlight)', 'Meia-noite (Midnight)', 'PRODUCT(RED)'] as $color)
                                <option value="{{ $color }}" @selected(old('color', $product->color) == $color)>{{ $color }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-3 field-animate" id="wrapper-repairs">
                        <label for="repairs" class="form-label">Histórico de Reparos / Peças Trocadas</label>
                        <input type="text" id="repairs" name="repairs" class="form-control" value="{{ old('repairs', $product->repairs) }}" placeholder="Ex: Tela trocada (original), Bateria nova, Nunca aberto">
                    </div>

                    <div class="col-12 col-md-6 mb-3 field-animate" id="wrapper-accessories">
                        <label for="accessories" class="form-label">Acessórios Inclusos</label>
                        <input type="text" id="accessories" name="accessories" class="form-control" value="{{ old('accessories', $product->accessories) }}" placeholder="Ex: Caixa original, carregador, cabo e capa de proteção">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header pb-2">
                <h6 class="mb-0">3. Rastreabilidade e Segurança</h6>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mb-3" id="wrapper-imei">
                        <label for="imei" id="label-imei" class="form-label">IMEI / Número de Série</label>
                        <input type="text" id="imei" name="imei" class="form-control" value="{{ old('imei', $product->imei) }}" placeholder="Insira os 15 dígitos do IMEI ou número de série">
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3" id="wrapper-guarantee">
                        <label for="guarantee" class="form-label">Garantia</label>
                        <select name="guarantee" id="guarantee" class="form-select cursor-pointer">
                            <option value="" disabled>Selecione a garantia</option>
                            @foreach(['1 ano fabricante' => '1 ano - Fabricante', 'Restante de Garantia - Fabricante' => 'Restante de Garantia - Fabricante', '90 dias loja' => '90 dias - Garantia da Loja', '30 dias loja' => '30 dias - Garantia da Loja', 'Sem garantia' => 'Sem garantia'] as $gVal => $gLabel)
                                <option value="{{ $gVal }}" @selected(old('guarantee', $product->guarantee) == $gVal)>{{ $gLabel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3 field-animate" id="wrapper-account-status">
                        <label for="account_status" class="form-label">Contas Vinculadas (iCloud / Google)</label>
                        <select name="account_status" id="account_status" class="form-select cursor-pointer">
                            <option value="Liberado" @selected(old('account_status', $product->account_status) == 'Liberado')>Livre / Desvinculado (Pronto p/ uso)</option>
                            <option value="Bloqueado" @selected(old('account_status', $product->account_status) == 'Bloqueado')>Bloqueado / Com Conta</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header pb-2">
                <h6 class="mb-0">4. Informações Comerciais</h6>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-12 col-md-4 mb-3">
                        <label for="cost_price" class="form-label">Preço de Custo / Compra (R$)</label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input type="number" step="0.01" id="cost_price" name="cost_price" class="form-control" value="{{ old('cost_price', $product->cost_price) }}" placeholder="0,00">
                        </div>
                        <small class="text-muted">Visível apenas no controle interno</small>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                        <label for="selling_price" class="form-label">Preço de Venda (R$)</label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input type="number" step="0.01" id="selling_price" name="selling_price" class="form-control" value="{{ old('selling_price', $product->selling_price) }}" placeholder="0,00" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                        <label for="quantity" class="form-label">Quantidade em Estoque</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" min="1" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header pb-2">
                <h6 class="mb-0">5. Fotos e Descrição</h6>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="images" class="form-label">Adicionar Novas Fotos</label>
                        <input type="file" id="images" name="images[]" class="form-control" multiple accept="image/*">
                        <small class="text-muted">Envie novas fotos caso deseje substituir ou adicionar fotos ao produto.</small>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Descrição / Observações Adicionais</label>
                        <textarea id="description" name="description" class="form-control" rows="4" placeholder="Detalhes adicionais...">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('catalogo.index') }}" class="btn btn-light me-2">Cancelar</a>
            <button type="submit" class="btn btn-success">Atualizar Produto</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deviceSelect = document.getElementById('device');
            const conditionSelect = document.getElementById('condition');
            const manufacturerSelect = document.getElementById('manufacturer_id');
            const modelSelect = document.getElementById('working_product_id');

            // Guarda o ID do modelo selecionado atualmente no produto
            const currentModelId = "{{ old('device_model_id', $product->device_model_id ?? $product->working_product_id) }}";

            const wrappers = {
                storage: document.getElementById('wrapper-storage'),
                ram: document.getElementById('wrapper-ram'),
                battery: document.getElementById('wrapper-battery'),
                grade: document.getElementById('wrapper-grade'),
                repairs: document.getElementById('wrapper-repairs'),
                accountStatus: document.getElementById('wrapper-account-status'),
                labelImei: document.getElementById('label-imei')
            };

            // Função para buscar modelos via API e pré-selecionar o modelo atual
            function loadModels(manufacturerId, selectedModelId = null) {
                modelSelect.innerHTML = '<option value="" selected disabled>Carregando modelos...</option>';
                modelSelect.disabled = true;

                if (!manufacturerId) return;

                fetch(`/api/manufacturers/${manufacturerId}/models`)
                    .then(response => response.json())
                    .then(models => {
                        modelSelect.innerHTML = '<option value="" disabled>Selecione o modelo</option>';

                        if (models.length === 0) {
                            modelSelect.innerHTML = '<option value="" selected disabled>Nenhum modelo cadastrado</option>';
                            return;
                        }

                        models.forEach(model => {
                            const option = document.createElement('option');
                            option.value = model.id;
                            option.textContent = model.name;
                            if (selectedModelId && model.id == selectedModelId) {
                                option.selected = true;
                            }
                            modelSelect.appendChild(option);
                        });

                        modelSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Erro ao buscar modelos:', error);
                        modelSelect.innerHTML = '<option value="" selected disabled>Erro ao carregar modelos</option>';
                    });
            }

            // Evento ao mudar o fabricante
            manufacturerSelect.addEventListener('change', function () {
                loadModels(this.value);
            });

            // Carrega os modelos inicialmente com o fabricante já selecionado no produto
            if (manufacturerSelect.value) {
                loadModels(manufacturerSelect.value, currentModelId);
            }

            function hideElement(el) {
                if (!el || el.tagName === 'LABEL') return;
                el.classList.add('field-fading');
                setTimeout(() => {
                    if (el.classList.contains('field-fading')) {
                        el.classList.add('field-hidden');
                    }
                }, 250);
            }

            function showElement(el) {
                if (!el || el.tagName === 'LABEL') return;
                el.classList.remove('field-hidden');
                setTimeout(() => {
                    el.classList.remove('field-fading');
                }, 10);
            }

            function toggleFields() {
                const device = deviceSelect.value;
                const condition = conditionSelect.value;
                const toHide = new Set();

                if (device === 'Fone' || device === 'Acessório') {
                    toHide.add(wrappers.storage);
                    toHide.add(wrappers.ram);
                    toHide.add(wrappers.accountStatus);
                    if (wrappers.labelImei) wrappers.labelImei.textContent = 'Número de Série (S/N)';
                } else if (device === 'Smartwatch') {
                    toHide.add(wrappers.ram);
                    if (wrappers.labelImei) wrappers.labelImei.textContent = 'IMEI / Número de Série';
                } else {
                    if (wrappers.labelImei) wrappers.labelImei.textContent = 'IMEI / Número de Série';
                }

                if (condition === 'Novo') {
                    toHide.add(wrappers.battery);
                    toHide.add(wrappers.grade);
                    toHide.add(wrappers.repairs);
                }

                Object.values(wrappers).forEach(el => {
                    if (toHide.has(el)) {
                        hideElement(el);
                    } else {
                        showElement(el);
                    }
                });
            }

            deviceSelect.addEventListener('change', toggleFields);
            conditionSelect.addEventListener('change', toggleFields);

            // Executa a verificação dos campos ocultos na inicialização
            toggleFields();
        });
    </script>
@endsection

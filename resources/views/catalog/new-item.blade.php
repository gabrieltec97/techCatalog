@extends('layouts.argon')

@section('content')
    <div class="card mb-4">
        <div class="card-body p-4 d-flex align-items-center justify-content-between">
            <div>
                <h5 class="mb-1">Novo Cadastro de Produto</h5>
                <p class="text-sm mb-0 text-muted">Cadastre um novo item no estoque. Preencha os dados com precisão para gerar anúncios transparentes.</p>
            </div>
            <a href="{{ route('catalogo.index') }}" class="btn btn-primary btn-sm mb-0 text-bold">Verificar Catálogo</a>
        </div>
    </div>

    <form action="{{ route('catalogo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mb-4">
            <div class="card-header pb-2">
                <h6 class="mb-0">1. Informações Básicas</h6>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="title" class="form-label">Título do Anúncio</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Ex: iPhone 13 Pro Max 256GB Grafite" required>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="device" class="form-label">Tipo de Dispositivo</label>
                        <select name="device" id="device" class="form-control cursor-pointer" required>
                            <option value="" selected disabled>Selecione o dispositivo</option>
                            <option value="Celular">Celular / Smartphone</option>
                            <option value="Tablet">Tablet / iPad</option>
                            <option value="Smartwatch">Smartwatch</option>
                            <option value="Fone">Fone / Headphone</option>
                            <option value="Acessório">Acessório / Carregador</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="manufacturer" class="form-label">Fabricante / Marca</label>
                        <select name="manufacturer" id="manufacturer" class="form-control cursor-pointer" required>
                            <option value="" selected disabled>Selecione a fabricante</option>
                            <option value="Apple">Apple</option>
                            <option value="Samsung">Samsung</option>
                            <option value="Xiaomi">Xiaomi</option>
                            <option value="Motorola">Motorola</option>
                            <option value="Realme">Realme</option>
                            <option value="Asus">Asus</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="model" class="form-label">Modelo</label>
                        <input type="text" id="model" name="model" class="form-control" placeholder="Ex: iPhone 13 Pro Max ou Galaxy S23" required>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="storage" class="form-label">Armazenamento Interno</label>
                        <select name="storage" id="storage" class="form-control cursor-pointer">
                            <option value="" selected disabled>Selecione a capacidade</option>
                            <option value="32GB">32 GB</option>
                            <option value="64GB">64 GB</option>
                            <option value="128GB">128 GB</option>
                            <option value="256GB">256 GB</option>
                            <option value="512GB">512 GB</option>
                            <option value="1TB">1 TB</option>
                            <option value="2TB">2 TB</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="ram" class="form-label">Memória RAM</label>
                        <select name="ram" id="ram" class="form-control cursor-pointer">
                            <option value="" selected disabled>Selecione a memória RAM</option>
                            <option value="3GB">3 GB</option>
                            <option value="4GB">4 GB</option>
                            <option value="6GB">6 GB</option>
                            <option value="8GB">8 GB</option>
                            <option value="12GB">12 GB</option>
                            <option value="16GB">16 GB</option>
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
                        <select name="condition" id="condition" class="form-control cursor-pointer" required>
                            <option value="" selected disabled>Selecione a condição</option>
                            <option value="Novo">Novo (Lacrado)</option>
                            <option value="Seminovo">Seminovo</option>
                            <option value="Recondicionado">Recondicionado (Refurbished)</option>
                            <option value="Usado">Usado</option>
                            <option value="Sucata">Sucata / Para Peças</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <label for="grade" class="form-label">Grau Estético</label>
                        <select name="grade" id="grade" class="form-control cursor-pointer">
                            <option value="" selected disabled>Selecione a condição estética</option>
                            <optgroup label="Novos">
                                <option value="Novo Lacrado">Novo (Lacrado na Caixa)</option>
                                <option value="Novo de Vitrine / Open Box">Novo de Vitrine / Open Box</option>
                            </optgroup>
                            <optgroup label="Seminovos / Usados">
                                <option value="Grau A+ (Impecável, sem marcas)">Grau A+ (Impecável, sem marcas)</option>
                                <option value="Grau A (Marcas mínimas de uso)">Grau A (Marcas mínimas de uso)</option>
                                <option value="Grau B (Marcas leves/riscos discretos)">Grau B (Marcas leves/riscos discretos)</option>
                                <option value="Grau C (Marcado/Sinais visíveis)">Grau C (Marcado/Sinais visíveis)</option>
                            </optgroup>
                            <optgroup label="Com Detalhes">
                                <option value="Tela com riscos visíveis">Tela com riscos visíveis</option>
                                <option value="Carcaça amassada/trincada">Carcaça amassada/trincada</option>
                                <option value="Para Retirada de Peças">Para Retirada de Peças</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <label for="battery" class="form-label">Saúde da Bateria (%)</label>
                        <div class="input-group">
                            <input type="number" min="0" max="100" id="battery" name="battery" class="form-control" placeholder="Ex: 88">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <label for="color" class="form-label">Cor</label>
                        <select name="color" id="color" class="form-control cursor-pointer">
                            <option value="" selected disabled>Selecione a cor</option>
                            <optgroup label="Cores Tradicionais">
                                <option value="Preto">Preto</option>
                                <option value="Branco">Branco</option>
                                <option value="Cinza">Cinza</option>
                                <option value="Prata">Prata</option>
                                <option value="Grafite">Grafite</option>
                                <option value="Dourado">Dourado</option>
                            </optgroup>
                            <optgroup label="Cores Padrão">
                                <option value="Azul">Azul</option>
                                <option value="Vermelho">Vermelho</option>
                                <option value="Verde">Verde</option>
                                <option value="Amarelo">Amarelo</option>
                                <option value="Roxo / Violeta">Roxo / Violeta</option>
                                <option value="Rosa">Rosa</option>
                                <option value="Laranja">Laranja</option>
                            </optgroup>
                            <optgroup label="Edições Especiais / Premium">
                                <option value="Azul Sierra / Pacífico">Azul Sierra / Pacífico</option>
                                <option value="Verde Alpino / Oliva">Verde Alpino / Oliva</option>
                                <option value="Roxo Profundo">Roxo Profundo</option>
                                <option value="Titânio Natural">Titânio Natural</option>
                                <option value="Titânio Preto">Titânio Preto</option>
                                <option value="Titânio Branco">Titânio Branco</option>
                                <option value="Titânio Azul">Titânio Azul</option>
                                <option value="Titânio Deserto">Titânio Deserto</option>
                                <option value="Estelar (Starlight)">Estelar (Starlight)</option>
                                <option value="Meia-noite (Midnight)">Meia-noite (Midnight)</option>
                                <option value="PRODUCT(RED)">PRODUCT(RED)</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="repairs" class="form-label">Histórico de Reparos / Peças Trocadas</label>
                        <input type="text" id="repairs" name="repairs" class="form-control" placeholder="Ex: Tela trocada (original), Bateria nova, Nunca aberto">
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="accessories" class="form-label">Acessórios Inclusos</label>
                        <input type="text" id="accessories" name="accessories" class="form-control" placeholder="Ex: Caixa original, carregador, cabo e capa de proteção">
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
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="imei" class="form-label">IMEI / Número de Série</label>
                        <input type="text" id="imei" name="imei" class="form-control" placeholder="Insira os 15 dígitos do IMEI">
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="guarantee" class="form-label">Garantia</label>
                        <select name="guarantee" id="guarantee" class="form-control cursor-pointer">
                            <option value="" selected disabled>Selecione a garantia</option>
                            <option value="1 ano fabricante">1 ano - Fabricante</option>
                            <option value="Restante de Garantia - Fabricante">Restante de Garantia - Fabricante</option>
                            <option value="90 dias loja">90 dias - Garantia da Loja</option>
                            <option value="30 dias loja">30 dias - Garantia da Loja</option>
                            <option value="Sem garantia">Sem garantia</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="account_status" class="form-label">Contas Vinculadas (iCloud / Google)</label>
                        <select name="account_status" id="account_status" class="form-control cursor-pointer">
                            <option value="Liberado" selected>Livre / Desvinculado (Pronto p/ uso)</option>
                            <option value="Bloqueado">Bloqueado / Com Conta</option>
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
                            <input type="number" step="0.01" id="cost_price" name="cost_price" class="form-control" placeholder="0,00">
                        </div>
                        <small class="text-muted">Visível apenas no controle interno</small>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                        <label for="selling_price" class="form-label">Preço de Venda (R$)</label>
                        <div class="input-group">
                            <span class="input-group-text">R$</span>
                            <input type="number" step="0.01" id="selling_price" name="selling_price" class="form-control" placeholder="0,00" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                        <label for="quantity" class="form-label">Quantidade em Estoque</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" required>
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
                        <label for="images" class="form-label">Fotos do Aparelho</label>
                        <input type="file" id="images" name="images[]" class="form-control" multiple accept="image/*">
                        <small class="text-muted">Selecione uma ou mais fotos do produto (especialmente se for usado).</small>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Descrição / Observações Adicionais</label>
                        <textarea id="description" name="description" class="form-control" rows="4" placeholder="Detalhes adicionais sobre o aparelho, marcas específicas ou informações relevantes para o cliente..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mb-5">
            <button type="button" class="btn btn-light me-2">Cancelar</button>
            <button type="submit" class="btn btn-success">Salvar Produto</button>
        </div>
    </form>
@endsection

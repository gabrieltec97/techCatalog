<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TechCatalog - Argon Dashboard</title>

    <!-- Fontes Globais -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons (CDN oficial do Argon) -->
    <link href="https://demos.creative-tim.com/argon-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- CSS Principal do Argon -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
<div class="min-height-300 bg-primary position-absolute w-100"></div>

<!-- Sidebar/Menu Lateral -->
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
        <a class="navbar-brand m-0" href="#">
            <span class="ms-1 font-weight-bold">TechCatalog</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-chart-line text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <!-- Submenu Catálogo -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#catalogoSubmenu" role="button" aria-expanded="false" aria-controls="catalogoSubmenu">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-boxes-packing text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Catálogo</span>
                </a>
                <div class="collapse" id="catalogoSubmenu">
                    <ul class="nav ms-3 ps-1 py-1">
                        <!-- Subitem: Ver Catálogo -->
                        <li class="nav-item">
                            <a class="nav-link py-1 px-2" href="#">
                                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-list text-primary text-sm opacity-10"></i>
                                </div>
                                <span class="sidenav-normal">Catálogo </span>
                            </a>
                        </li>
                        <!-- Subitem: Novo Cadastro -->
                        <li class="nav-item">
                            <a class="nav-link py-1 px-2" href="#">
                                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-circle-plus text-success text-sm opacity-10"></i>
                                </div>
                                <span class="sidenav-normal"> Novo Cadastro </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Usuários -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Usuários</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<main class="main-content position-relative border-radius-lg">
    <!-- Navbar Superior -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <span class="font-weight-bold text-white">Dashboard</span>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Dinâmico -->
    <div class="container-fluid py-4">
        @yield('content')
    </div>
</main>

<!-- Core JS Files -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
</body>
</html>

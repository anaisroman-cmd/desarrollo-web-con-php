<?php

session_start();
$ruta = ['assets' => '../../', 'components' => '../'];
$_SESSION['ruta'] = $ruta;

include_once '../mvc/v1/conexion.php';
include_once '../mvc/v1/models/usuario.php';

$modelo = new Usuario();
$data = $modelo->getAll();



?>


<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $_SESSION['titulos']['webTitle'] ?></title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE 4 | General UI Elements" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="<?php echo $ruta['assets'] ?>assets/css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media = 'all'" />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?php echo $ruta['assets'] ?>assets/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <style>
        /* 1. Ocultamos el fondo problemático original */
        .modal-backdrop {
            display: none !important;
        }

        /* 2. Le damos al modal un fondo transparente que se pueda animar */
        .modal {
            background-color: transparent;
            transition: background-color 0.3s ease-in-out !important;
        }

        /* 3. Cuando Bootstrap abre el modal, oscurecemos el fondo suavemente */
        .modal.show {
            background-color: rgba(0, 0, 0, 0.5) !important;
        }
    </style>
</head>
</head>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <?php include_once($ruta['components'] . 'components/nav-v1.php'); ?>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <?php include_once($ruta['components'] . 'components/aside-v1.php'); ?>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Mantenedor de Usuarios</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="/desarrollo-web-con-php/">Backoffice</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                                <li class="breadcrumb-item"><button class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal" data-bs-target="#mantenedorAgregar"> Agregar
                                        +</button>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row g-4">
                        <!--begin::Col-->
                        <div class="col-12">
                            <?php
                            try {    
                                if (count(@$_SESSION['errores']['items']) > 0) {
                                    if (@$_SESSION['errores']['items']['email']) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Error Email: </strong><?php echo $_SESSION['errores']['items']['email']; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    <?php }
                                    if (@$_SESSION['errores']['items']['name']) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Error Nombre: </strong><?php echo $_SESSION['errores']['items']['name']; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                        <?php
                                    }
                                }
                            } catch (\Throwable $th) {
                                //throw $th;
                            } ?>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-12">
                            <!--begin::DataTable-->
                            <div class="card card-primary card-outline mb-4">
                                <!--begin::Header-->
                                <div class="card-header">
                                    <div class="card-title">Lista de Ususarios del Sistema</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body p-0">
                                    <table class="table table-striped" role="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px" scope="col">#</th>
                                                <th scope="col">Nombre Completo</th>
                                                <th scope="col">Estado</th>
                                                <th style="width: 40px" scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <?php if (count($data) > 0) { $num = 1 ?>
                                            <tbody>
                                                <?php foreach ($data as $registro) { ?>
                                                    <tr class="align-middle">
                                                        <td><?php echo $registro->getId(); ?></td>
                                                        <td><?php echo $registro->getNombre() . ' ' . $registro->getApellido(); ?></td>
                                                        <td>
                                                            <span class="badge text-bg-<?php echo $registro->isActive() == 1 ? 'success' : 'danger' ?>"><?php echo $registro->isActive() == 1 ? 'Activo' : 'Inactivo' ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-secondary dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="bi bi-list"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">Ver</a></li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#">Editar</a>
                                                                    </li>
                                                                    <?php if($registro->isActive() == 1 ) { ?>
                                                                    <li>
                                                                        <form action="./powerOFF/" method="post">
                                                                            <input type="text" class="d-none" name="id" value="<?php echo $registro->getId() ?>">
                                                                            <button type="submit" class="dropdown-item">Apagar</button>
                                                                        </form>
                                                                        <!-- <a class="dropdown-item" href="./powerOFF/">Apagar LINK</a> -->
                                                                    </li>                                                                    
                                                                    <?php } ?>
                                                                    <?php if($registro->isActive() == 0 ) { ?>
                                                                    <li>
                                                                        <form action="./powerON/" method="post">
                                                                            <input type="text" class="d-none" name="id" value="<?php echo $registro->getId() ?>">
                                                                            <button type="submit" class="dropdown-item">Encender</button>
                                                                        </form>
                                                                        <!-- <a class="dropdown-item" href="powerON">Encender LINK</a> -->
                                                                    </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $num++; 
                                                } ?>                           
                                            </tbody>
                                        <?php } else { ?>
                                            <tbody>
                                                <tr class="align-middle">
                                                    <td colspan="4" class="text-center">Sin datos en la Base de Datos</td>
                                                </tr>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::DataTable-->
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
            <div class="modal fade" id="mantenedorAgregar" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="./add/" method="post">
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="">
                                    <label for="floatingInput">Usuario (Utilice el Email)</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="">
                                    <label for="name">Nombre</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        placeholder="">
                                    <label for="lastname">Apellido</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                    <label for="password">Password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password2" placeholder="Password">
                                    <label for="password2">Reingrese Password</label>
                                </div>
                                <div class="form-floating">
                                    <select class="form-select" id="rol" name="rol" aria-label="Floating label select">
                                        <option value="1">Admin</option>
                                        <option value="2">Vendedor</option>
                                        <option value="3" selected>Usuario</option>
                                    </select>
                                    <label for="rol">Seleccione un rol para el usuario</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <?php include_once($ruta['components'] . 'components/footer-v1.php'); ?>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="<?php echo $ruta['assets'] ?>assets/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

            // Disable OverlayScrollbars on mobile devices to prevent touch interference
            const isMobile = window.innerWidth <= 992;

            if (
                sidebarWrapper &&
                OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
                !isMobile
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--begin::Bootstrap Tooltips-->
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach((tooltipTriggerEl) => {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
    <!--end::Bootstrap Tooltips-->
    <!--begin::Bootstrap Toasts-->
    <script>
        const toastTriggerList = document.querySelectorAll('[data-bs-toggle="toast"]');
        toastTriggerList.forEach((btn) => {
            btn.addEventListener('click', (event) => {
                event.preventDefault();
                const toastEle = document.getElementById(btn.getAttribute('data-bs-target'));
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEle);
                toastBootstrap.show();
            });
        });
    </script>
    <!--end::Bootstrap Toasts-->

    <!--end::Script-->
</body>
<!--end::Body-->

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GroLancer</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8184c6fef3.js" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <script src="https://cdn.tiny.cloud/1/1ud1pvkf8goe63u3y9avrcfy29q3awxnqe87iebwxkpuzf2s/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/dashboard">
            <img class="logo" src="{{ asset('img/grolancer-logo.png') }}" alt="">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="/contacts" method="GET">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search contacts..." aria-label="Search for..." aria-describedby="btnNavbarSearch" name="search" id="search" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="small-profile-pic" src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('img/no-avatar.png') }}" alt="">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/users/edit">Account Settings</a></li>
                    <li><a class="dropdown-item" href="/users/billing">Billing</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-dark"><i class="fa-solid fa-door-closed"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">

        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="/dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        {{-- <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div> --}}
                        {{-- <div class="sb-sidenav-menu-heading">CRM</div> --}}
                        <a class="nav-link" href="/contacts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-address-book"></i></div>
                            Contacts
                        </a>
                        {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-address-book"></i></div>
                            Contacts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a> --}}
                        {{-- <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/contacts/create">New</a>
                                <a class="nav-link" href="/contacts">All </a>
                                <a class="nav-link" href="/contacts?type=prospect">Prospects</a>
                                <a class="nav-link" href="/contacts?type=lead">Leads</a>
                                <a class="nav-link" href="/contacts?type=client">Clients</a>
                            </nav>
                        </div> --}}
                        {{-- <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a> --}}
                        {{-- <div class="sb-sidenav-menu-heading">Workflow</div> --}}
                        <a class="nav-link" href="/tasks">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-list-check"></i></div>
                            Tasks
                        </a>

                        {{-- <div class="sb-sidenav-menu-heading">Payments</div> --}}
                        <a class="nav-link" href="/invoices">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                            Invoices
                        </a>

                        <a class="nav-link" href="/proposals">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file-signature"></i></div>
                            Proposals
                        </a>

                        <a class="nav-link" href="/timing">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-stopwatch"></i></div>
                            Timing
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ auth()->user()->username}}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">

            <x-flash-message />

            <main>

                @yield('content')

            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">
                            Copyright &copy; GroLancer {{ date('Y') }} | 
                            {{ env('APP_VERSION') }}
                        </div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>



        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        tinymce.init({
            selector: '#body',
            height: 400,
        });
    </script>
</body>
</html>
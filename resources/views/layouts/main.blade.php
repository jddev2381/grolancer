<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GroLancer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8184c6fef3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 fixed-top">
        <div class="container">
            <a href="/" class="navbar-brand">
                <img class="img-fluid" src="img/grolancer-logo.png" alt="GroLancer Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navmenu" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    @auth

                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">Welcome, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link"><i class="fa-solid fa-door-closed"></i> Logout</button>
                            </form>
                        </li>

                    @else
                        <li class="nav-item">
                            <a href="#" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#faq" class="nav-link">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">Contact</a>
                        </li>
                    
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Register</a>
                        </li>

                        <li class="nav-item">
                            <a href="/login" class="nav-link">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>


@yield('content')





<!-- Footer -->
<footer class="p-5 bg-dark text-white text-center position-relative">
    <div class="container">
        <p class="lead">Copyright &copy; 2022 GroLancer</p>
        <a class="position-absolute bottom-0 end-0 p-5" href="#home">
            <i class="fa-solid fa-circle-chevron-up text-logo"></i>
        </a>
    </div>
</footer>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
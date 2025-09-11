<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-hands-helping"></i>ActTogether
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/show/missions">Missions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#features">Fonctionnalités</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#testimonials">Témoignages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
            <div class="d-flex">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Connexion</a>
                @endif
                <div class="dropdown">

                    <button 
                        class="btn btn-primary dropdown-toggle" 
                        type="button" 
                        id="dropdownMenuButton1" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false"

                    >
                        Inscription
                    </button>
                      
                      @if (Route::has('register'))
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('register') }}">Je suis bénévole</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Je suis une association</a></li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
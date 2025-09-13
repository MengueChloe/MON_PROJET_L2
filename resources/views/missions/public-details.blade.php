<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <title>ActTogether - {{ $mission->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #e2001a;
            --secondary-color: #ff7f00;
            --light-color: #f8f9fc;
            --dark-color: #333333;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .navbar {
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: var(--primary-color);
        }

        .navbar-brand i {
            margin-right: 10px;
        }

        .nav-link {
            font-weight: 500;
            margin: 0 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.8rem 2rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #c10015;
            border-color: #c10015;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .section-title {
            position: relative;
            margin-bottom: 3rem;
            text-align: center;
        }

        .section-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--primary-color);
            margin: 15px auto;
            border-radius: 2px;
        }

        .mission-header {
            background: linear-gradient(135deg, rgba(226, 0, 26, 0.9), rgba(165, 0, 18, 0.9)), url('https://source.unsplash.com/1400x400/?volunteer,community,{{ rand(1,1000) }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 6rem 0;
            margin-top: -76px;
            padding-top: 10rem;
        }

        .mission-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        .mission-meta {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .organisation-card {
            background: var(--light-color);
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .organisation-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        footer {
            background: var(--dark-color);
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin-right: 1rem;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: var(--secondary-color);
        }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <!-- Navigation -->
    @include('partials.navbar')

    <!-- Mission Header -->
    <section class="mission-header mt-4">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">{{ $mission->title }}</h1>
            <div class="mission-meta text-white">
                <p class="mb-1"><i class="fas fa-building me-2"></i>{{ $mission->organisation->name }}</p>
                @if ($mission->start_date)
                    <p class="mb-1"><i class="fas fa-calendar-alt me-2"></i>{{ $mission->start_date }} @if ($mission->end_date) - {{ $mission->end_date }} @endif</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Mission Details -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mission-card mb-4">
                        <h2 class="section-title">Détails de la mission</h2>
                        <p>{{ $mission->description }}</p>
                        @if ($mission->start_date || $mission->end_date)
                            <h4 class="mt-4">Période</h4>
                            <p>
                                @if ($mission->start_date)
                                    Début : {{ $mission->start_date }}
                                @endif
                                @if ($mission->end_date)
                                    - Fin : {{ $mission->end_date }}
                                @endif
                            </p>
                        @endif
                        <h4 class="mt-4">Statut</h4>
                        <p>{{ $mission->is_published ? 'Publiée' : 'Non publiée' }}</p>
                    </div>
                    @auth
                        @if (auth()->user()->type === 'benevole')
                            @if ($existingCandidature)
                                <div class="alert alert-info">
                                    Vous avez déjà postulé à cette mission. Statut : {{ $existingCandidature->status }}
                                </div>
                            @else
                                <form action="{{ route('candidacies.store') }}" method="POST" class="mb-4">
                                    @csrf
                                    <input type="hidden" name="mission_id" value="{{ $mission->id }}">
                                    <input type="hidden" name="benevole_id" value="{{ auth()->user()->benevole->id }}">
                                    <div class="mb-3">
                                        <label for="motivation" class="form-label">Lettre de motivation (facultatif)</label>
                                        <textarea name="motivation" id="motivation" class="form-control" rows="5" placeholder="Expliquez pourquoi vous souhaitez rejoindre cette mission..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg">Postuler à la mission</button>
                                </form>
                            @endif
                        @endif
                    @endauth
                    @guest
                        <div class="alert alert-info">
                            <a href="{{ route('login') }}" class="text-decoration-none">Connectez-vous</a> pour postuler à cette mission.
                        </div>
                    @endguest
                </div>
                <div class="col-lg-4">
                    <div class="organisation-card">
                        <h3 class="mb-3">À propos de l'organisation</h3>
                        <img src="https://source.unsplash.com/100x100/?ngo,organization,{{ rand(1,1000) }}" alt="{{ $mission->organisation->name }}" class="img-fluid">
                        <h4>{{ $mission->organisation->name }}</h4>
                        @if ($mission->organisation->address)
                            <p class="mission-meta"><i class="fas fa-map-marker-alt me-2"></i>{{ $mission->organisation->address }}</p>
                        @endif
                        @if ($mission->organisation->website)
                            <p class="mission-meta"><i class="fas fa-globe me-2"></i><a href="{{ $mission->organisation->website }}" target="_blank" class="text-decoration-none">{{ $mission->organisation->website }}</a></p>
                        @endif
                        @if ($mission->organisation->description)
                            <p>{{ Str::limit($mission->organisation->description, 150) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow');
            } else {
                navbar.classList.remove('shadow');
            }
        });
    </script>
</body>
</html>
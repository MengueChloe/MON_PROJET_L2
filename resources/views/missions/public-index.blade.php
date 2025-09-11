<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missions - ActTogether</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
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
        
        .hero-section {
            background: linear-gradient(135deg, rgba(226, 0, 26, 0.9), rgba(165, 0, 18, 0.9)), url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1400&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 6rem 0;
            margin-top: -76px;
            padding-top: 10rem;
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
        
        .feature-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            height: 100%;
            text-align: center;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }
        
        .testimonial-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin: 1rem;
        }
        
        .testimonial-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1.5rem;
        }
        
        .stats-section {
            background: linear-gradient(135deg, var(--primary-color), #a50012);
            color: white;
            padding: 4rem 0;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .cta-section {
            background: var(--light-color);
            padding: 5rem 0;
            text-align: center;
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

        .mission-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all .3s ease;
            overflow: hidden;
        }
        .mission-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.15);
        }
        .mission-card img {
            height: 180px;
            width: 100%;
            object-fit: cover;
        }
        .mission-card .card-body {
            padding: 1.5rem;
        }
        .btn-apply {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 600;
            border-radius: 8px;
            padding: .6rem 1.4rem;
        }
        .btn-apply:hover {
            background-color: #c10015;
            border-color: #c10015;
        }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <!-- Navigation -->
    @include('partials.navbar')

    <div class="container py-5 mt-5">
        <h1 class="text-center mb-5">Découvrez nos missions disponibles</h1>

        <div class="row g-4">
            @foreach($missions as $mission)
                <div class="col-md-6 col-lg-4">
                    <div class="mission-card h-100">
                        @if($mission->image)
                            <img src="{{ asset('storage/'.$mission->image) }}" alt="Mission {{ $mission->title }}">
                        @else
                            <img src="https://picsum.photos/600/400?random={{ $mission->id }}" alt="Mission par défaut">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $mission->title }}</h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-map-marker-alt text-danger"></i>
                                {{ $mission->location ?? 'Non précisé' }}
                            </p>
                            <p class="card-text flex-grow-1">{{ Str::limit($mission->description, 120) }}</p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-secondary">{{ $mission->category ?? 'Général' }}</span>
                                @auth
                                    <a href="{{ route('missions.apply', $mission->id) }}" class="btn btn-apply">
                                        <i class="fas fa-hand-holding-heart"></i> Postuler
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-sign-in-alt"></i> Se connecter
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $missions->links() }}
        </div>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

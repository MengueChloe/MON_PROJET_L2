<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" /> -->

        <title>ActTogether - Plateforme de bénévolat</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
       
        <!-- Styles -->
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
    background: linear-gradient(135deg, rgba(74, 38, 43, 0.7), rgba(73, 40, 46, 0.94)),
        url('https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=1200&q=80.jpg');
    background-size: cover;
    background-position: center;
    color: white;
    padding: 10rem 0;
    margin-top: -10px;
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
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        
        <!-- Navigation -->
         @include('partials.navbar')

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="display-4 fw-bold mb-4">Agissez ensemble pour un monde meilleur</h1>
                        <p class="lead mb-5">Rejoignez la plateforme qui connecte les bénévoles passionnés avec les associations qui ont besoin de vous. Ensemble, faisons la différence !</p>
                        @if (Route::has('register'))
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('register') }}" class="btn btn-lg btn-primary">Devenir bénévole</a>
                                <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light">Inscrire mon association</a>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-4 mb-md-0">
                        <div class="stat-number">1,250+</div>
                        <div class="stat-label">Bénévoles actifs</div>
                    </div>
                    <div class="col-md-3 col-6 mb-4 mb-md-0">
                        <div class="stat-number">350+</div>
                        <div class="stat-label">Associations</div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-number">5,700+</div>
                        <div class="stat-label">Missions réalisées</div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-number">25,000+</div>
                        <div class="stat-label">Heures de bénévolat</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-5" style="background-color: #f8f9fa;">
            <div class="container py-5">
                <h2 class="section-title">Comment ça marche</h2>
                <div class="row">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="img-fluid rounded shadow" alt="Comment ça marche">
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-lg-5">
                            <h3 class="mb-4">Une plateforme simple et efficace</h3>
                            <div class="d-flex mb-4">
                                <div class="me-4">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <span class="fw-bold">1</span>
                                    </div>
                                </div>
                                <div>
                                    <h4>Inscrivez-vous</h4>
                                    <p>Créez votre compte en tant que bénévole ou association en quelques minutes.</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="me-4">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <span class="fw-bold">2</span>
                                    </div>
                                </div>
                                <div>
                                    <h4>Connectez-vous</h4>
                                    <p>Bénévoles : trouvez des missions qui correspondent à vos compétences et disponibilités.</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="me-4">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <span class="fw-bold">3</span>
                                    </div>
                                </div>
                                <div>
                                    <h4>Agissez</h4>
                                    <p>Associations : publiez vos missions et trouvez les bénévoles dont vous avez besoin.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-5">
            <div class="container py-5">
                <h2 class="section-title">Nos fonctionnalités</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3>Recherche avancée</h3>
                            <p>Trouvez des missions qui correspondent à vos compétences, centres d'intérêt et disponibilités.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h3>Gestion des disponibilités</h3>
                            <p>Indiquez vos créneaux disponibles et recevez des propositions de missions correspondantes.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3>Suivi d'impact</h3>
                            <p>Visualisez l'impact de votre bénévolat avec des statistiques détaillées et un historique de vos missions.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <h3>Messagerie intégrée</h3>
                            <p>Communiquez facilement avec les associations et autres bénévoles via notre messagerie sécurisée.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3>Système d'évaluation</h3>
                            <p>Évaluez vos expériences de bénévolat et consultez les avis sur les associations.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h3>Application mobile</h3>
                            <p>Accédez à toutes les fonctionnalités depuis votre smartphone, disponible sur iOS et Android.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="py-5 bg-light">
            <div class="container py-5">
                <h2 class="section-title">Ils nous font confiance</h2>
                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-3">
                                <img src="WhatsApp Image 2025-09-21 à 19.27.41_4c6ac88e.p" class="testimonial-avatar" alt="Cyriale">
                                <div>
                                    <h5 class="mb-0">Cyriale</h5>
                                    <p class="text-muted mb-0">Bénévole régulier</p>
                                </div>
                            </div>
                            <p class="mb-0">"ActTogether m'a permis de trouver des missions qui correspondent parfaitement à mes compétences et à mes disponibilités. J'ai déjà participé à 15 missions en 6 mois !"</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-3">
                                <img src="WhatsApp Image 2025-09-21 à 19.25.44_d0ef1ec6.jpeg" class="testimonial-avatar" alt="Brea">
                                <div>
                                    <h5 class="mb-0">Brea</h5>
                                    <p class="text-muted mb-0">Responsable association</p>
                                </div>
                            </div>
                            <p class="mb-0">"Grâce à ActTogether, nous avons pu trouver des bénévoles compétents et motivés pour nos actions. La plateforme est intuitive et nous fait gagner un temps précieux."</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-3">
                                <img src="" class="testimonial-avatar" alt="Nicolas">
                                <div>
                                    <h5 class="mb-0">CHARLES-LOUANGA</h5>
                                    <p class="text-muted mb-0">Bénévole occasionnel</p>
                                </div>
                            </div>
                            <p class="mb-0">"En tant que père de famille avec un emploi du temps chargé, ActTogether me permet de trouver des missions ponctuelles qui s'adaptent à mes disponibilités. Très pratique !"</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <h2 class="section-title">Prêt à faire la différence ?</h2>
                <p class="lead mb-5">Rejoignez notre communauté de bénévoles et d'associations engagées</p>
                @if (Route::has('register.benevole') && Route::has('register.association'))
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        <a href="{{ route('register.benevole') }}" class="btn btn-primary btn-lg">Commencer en tant que bénévole</a>
                        <a href="{{ route('register.association') }}" class="btn btn-outline-primary btn-lg">Inscrire mon association</a>
                    </div>
                @endif
            </div>
        </section>

        @include('partials.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Animation for smooth scrolling
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

        {{-- @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif --}}
    </body>
</html>

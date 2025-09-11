<!-- Footer -->
<footer id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h4 class="text-white mb-4"><i class="fas fa-hands-helping me-2"></i>ActTogether</h4>
                <p>La plateforme qui connecte les bénévoles avec les associations pour créer un impact positif dans la communauté.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h5 class="text-white mb-4">Liens rapides</h5>
                <ul class="footer-links">
                    <li><a href="#about">À propos</a></li>
                    <li><a href="#features">Fonctionnalités</a></li>
                    <li><a href="#testimonials">Témoignages</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h5 class="text-white mb-4">Pour les bénévoles</h5>
                <ul class="footer-links">
                    @if (Route::has('register.benevole'))
                        <li><a href="{{ route('register.benevole') }}">Devenir bénévole</a></li>
                    @endif
                    
                    <li><a href="#">Trouver une mission</a></li>
                    <li><a href="#">Témoignages</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                <h5 class="text-white mb-4">Contactez-nous</h5>
                <ul class="footer-links">
                    <li><i class="fas fa-map-marker-alt me-2"></i> 123 Rue de l'Entraide, Paris</li>
                    <li><i class="fas fa-phone me-2"></i> +33 1 23 45 67 89</li>
                    <li><i class="fas fa-envelope me-2"></i> contact@acttogether.fr</li>
                </ul>
            </div>
        </div>
        <hr class="my-4 bg-light">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">&copy; 2023 ActTogether. Tous droits réservés.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="text-white me-3">Politique de confidentialité</a>
                <a href="#" class="text-white">Conditions d'utilisation</a>
            </div>
        </div>
    </div>
</footer>
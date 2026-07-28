<footer class="footer-section">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4 col-md-6">
        <h4 class="text-white mb-4"><i class="fa-solid fa-paw me-2"></i> Huellas Felices</h4>
        <p class="text-white-50 mb-4">Conectando corazones solitarios con patitas que necesitan un hogar. Juntos
          hacemos la diferencia.</p>
        <div class="d-flex gap-3">
          <a href="#" class="btn btn-outline-light rounded-circle social-btn"><i
              class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="btn btn-outline-light rounded-circle social-btn"><i class="fa-brands fa-twitter"></i></a>
          <a href="#" class="btn btn-outline-light rounded-circle social-btn"><i class="fa-brands fa-instagram"></i></a>
        </div>
      </div>
      <div class="col-lg-2 col-md-6">
        <h5 class="text-white mb-4">Enlaces</h5>
        <ul class="list-unstyled footer-links">
          <li><a href="index.php?action=index">Inicio</a></li>
          <li><a href="index.php?action=catalogo">Catálogo</a></li>
          <li><a href="index.php?action=login">Iniciar Sesión</a></li>
          <li><a href="index.php?action=registrarse">Registro</a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-6">
        <h5 class="text-white mb-4">Políticas</h5>
        <ul class="list-unstyled footer-links">
          <li><a href="#">Términos y Condiciones</a></li>
          <li><a href="#">Política de Privacidad</a></li>
          <li><a href="#">Proceso de Adopción</a></li>
          <li><a href="#">Preguntas Frecuentes</a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-6">
        <h5 class="text-white mb-4">Contacto</h5>
        <ul class="list-unstyled text-white-50 contact-info">
          <li><i class="fa-solid fa-location-dot"></i> San José, Costa Rica</li>
          <li><i class="fa-solid fa-phone"></i> +506 2222-3333</li>
          <li><i class="fa-solid fa-envelope"></i> info@huellasfelices.com</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom mt-5">
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          <p class="mb-0 text-white-50">&copy; 2026 Huellas Felices. Todos los derechos reservados.</p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <p class="mb-0 text-white-50 small">Hecho con <i class="fa-solid fa-heart text-danger"></i> para los animales
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php if(isset($extra_js)): ?>
<script src="js/<?php echo $extra_js; ?>"></script>
<?php endif; ?>
</body>
</html>
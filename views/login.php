<?php
$page_title = "Huellas Felices - Iniciar SesiÃ³n";
$extra_css = "autenticacion.css";
include 'layout/header.php';
?>

<main class="container py-5 d-flex align-items-center justify-content-center auth-main">
  <div class="card p-md-5 border-0 bg-white mx-auto auth-card auth-card-login">
    <div class="text-center mb-4">
      <i class="fa-solid fa-paw fs-1 text-verde mb-2"></i>
      <h1 class="h3 fw-bold">Bienvenido</h1>
      <p class="text-secondary small">Ingresa tus datos para administrar tus mascotas rescatadas.</p>
    </div>

    <!-- control de errores -->
    <?php if (isset($_GET['error'])): ?>
      <?php if ($_GET['error'] == 'inactivo'): ?>
        <div class="alert alert-danger text-center small fw-semibold"><i class="fa-solid fa-ban me-1"></i> Tu cuenta ha sido desactivada por un administrador.</div>
      <?php else: ?>
        <div class="alert alert-danger text-center small fw-semibold">Correo o contraseña incorrectos.</div>
      <?php endif; ?>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success text-center small fw-semibold">Registro exitoso. Ahora puedes iniciar sesión.</div>
    <?php endif; ?>

    <form id="form-login" action="index.php?action=login_post" method="POST" class="needs-validation" novalidate>
      <div class="mb-3">
        <label for="loginEmail" class="form-label fw-600">Correo Electrónico *</label>
        <div class="input-group">
          <span class="input-group-text bg-light border-2 border-end-0 input-left-radius"><i
              class="fa-regular fa-envelope text-muted"></i></span>
          <input type="email" name="correo" class="form-control border-2 border-start-0 input-right-radius"
            id="loginEmail" placeholder="correo@refugio.com" required value="elena@huellasfelices.com">
          <div class="invalid-feedback">Ingresa tu correo electrónico registrado.</div>
        </div>
      </div>

      <div class="mb-4">
        <div class="d-flex justify-content-between mb-1">
          <label for="loginPassword" class="form-label fw-600 mb-0">Contraseña *</label>
          <a href="#" class="small auth-link fw-500">¿La olvidaste?</a>
        </div>
        <div class="input-group">
          <span class="input-group-text bg-light border-2 border-end-0 input-left-radius"><i
              class="fa-solid fa-lock text-muted"></i></span>
          <input type="password" name="contrasena" class="form-control border-2 border-start-0 input-right-radius"
            id="loginPassword" placeholder="••••••••••" required value="password">
          <div class="invalid-feedback">Ingresa tu contraseña de rescatista.</div>
        </div>
      </div>

      <!-- Checkbox de recordar usuario -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
          <input type="checkbox" class="form-check-input auth-checkbox" id="rememberMe" checked>
          <label class="form-check-label small text-secondary" for="rememberMe">Mantener sesión abierta</label>
        </div>
      </div>

      <!-- ingresar -->
      <button type="submit" class="btn btn-mustard w-100 py-3 auth-btn"><i
          class="fa-solid fa-right-to-bracket me-2"></i>Iniciar Sesión</button>
    </form>

    <div class="text-center mt-4">
      <p class="small text-secondary mb-0">¿Aún no tienes cuenta? <a href="index.php?action=registrarse"
          class="auth-link">¡Regístrate!</a></p>
    </div>
  </div>
</main>

<?php include 'layout/footer.php'; ?>
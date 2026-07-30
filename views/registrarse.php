<?php
$page_title = "Huellas Felices - Registrarse";
$extra_css = "autenticacion.css";
include 'layout/header.php';
?>

<main class="container py-5 d-flex align-items-center justify-content-center auth-main">
  <div class="card p-md-5 border-0 bg-white mx-auto auth-card auth-card-registro">
    <div class="text-center mb-4">
      <i class="fa-solid fa-paw fs-1 text-verde mb-2"></i>
      <h1 class="h3 fw-bold">Crear Cuenta de Rescatista</h1>
      <p class="text-secondary small">Únete y empieza a publicar perfiles de mascotas para adopción.</p>
    </div>

    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger text-center small fw-semibold">Hubo un error al crear la cuenta. Por favor intenta de nuevo.</div>
    <?php endif; ?>

    <form id="form-registro" action="index.php?action=registro_post" method="POST" class="needs-validation" novalidate>
      <div class="mb-3">
        <label for="regNombre" class="form-label fw-600">Nombre *</label>
        <input type="text" name="nombre" class="form-control border-2 auth-input" id="regNombre" placeholder="Tu nombre" required>
        <div class="invalid-feedback">Por favor ingresa tu nombre completo.</div>
      </div>

      <div class="mb-3">
        <label for="regApellido" class="form-label fw-600">Apellido *</label>
        <input type="text" name="apellido" class="form-control border-2 auth-input" id="regApellido"
          placeholder="Tu apellido" required>
        <div class="invalid-feedback">Por favor ingresa tu apellido.</div>
      </div>

      <div class="mb-3">
        <label for="regEmail" class="form-label fw-600">Correo Electrónico *</label>
        <input type="email" name="correo" class="form-control border-2 auth-input" id="regEmail" placeholder="correo@ejemplo.com"
          required>
        <div class="invalid-feedback">Ingresa un correo electrónico válido.</div>
      </div>

      <div class="mb-3">
        <label for="regPassword" class="form-label fw-600">Contraseña *</label>
        <input type="password" name="contrasena" class="form-control border-2 auth-input" id="regPassword"
          placeholder="Crea una contraseña segura" required>
        <div class="invalid-feedback">Ingresa una contraseña.</div>
      </div>

      <div class="mb-4">
        <label for="regTelefono" class="form-label fw-600">Teléfono (Opcional)</label>
        <input type="text" name="telefono" class="form-control border-2 auth-input" id="regTelefono"
          placeholder="Ej. 8888-8888">
        <div class="invalid-feedback">Confirma tu contraseña.</div>
      </div>

      <button type="submit" class="btn btn-verde w-100 py-3 auth-btn"><i
          class="fa-solid fa-user-plus me-2"></i>Registrarse</button>
    </form>

    <div class="text-center mt-4">
      <p class="small text-secondary mb-0">¿Ya tienes una cuenta? <a href="index.php?action=iniciar-sesion"
          class="auth-link">Inicia sesión de una vez</a></p>
    </div>
  </div>
</main>

<?php include 'layout/footer.php'; ?>
<?php
$page_title = "Huellas Felices - Mi Perfil";
include 'layout/header.php';
?>

<main class="container py-5 my-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-navy text-white p-4">
          <h2 class="h4 mb-0 fw-bold"><i class="fa-solid fa-user-circle me-2"></i> Mi Perfil</h2>
        </div>
        <div class="card-body p-4 p-md-5">

          <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
              <i class="fa-solid fa-check-circle me-2"></i>
              <div>Perfil actualizado correctamente.</div>
            </div>
          <?php endif; ?>

          <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
              <i class="fa-solid fa-triangle-exclamation me-2"></i>
              <div>Hubo un error al actualizar tu perfil.</div>
            </div>
          <?php endif; ?>

          <form action="index.php?action=perfil_post" method="POST" class="needs-validation" novalidate>
            
            <div class="row g-4 mb-4">
              <div class="col-md-6">
                <label for="nombre" class="form-label fw-semibold">Nombre *</label>
                <input type="text" class="form-control form-control-lg border-light-subtle bg-light" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
                <div class="invalid-feedback">Por favor ingresa tu nombre.</div>
              </div>
              <div class="col-md-6">
                <label for="apellido" class="form-label fw-semibold">Apellido *</label>
                <input type="text" class="form-control form-control-lg border-light-subtle bg-light" id="apellido" name="apellido" value="<?= htmlspecialchars($usuario['apellido']) ?>" required>
                <div class="invalid-feedback">Por favor ingresa tu apellido.</div>
              </div>
            </div>

            <div class="row g-4 mb-4">
              <div class="col-md-6">
                <label for="correo" class="form-label fw-semibold">Correo Electrónico</label>
                <input type="email" class="form-control form-control-lg border-light-subtle bg-light" id="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" disabled>
                <div class="form-text">El correo electrónico no puede ser modificado.</div>
              </div>
              <div class="col-md-6">
                <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                <input type="text" class="form-control form-control-lg border-light-subtle bg-light" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">
              </div>
            </div>

            <hr class="my-5 text-light-subtle">
            
            <h5 class="mb-4 text-navy fw-bold">Cambiar Contraseña</h5>
            <p class="text-muted small mb-4">Si no deseas cambiar tu contraseña, deja estos campos en blanco.</p>

            <div class="row g-4 mb-5">
              <div class="col-md-6">
                <label for="contrasena" class="form-label fw-semibold">Nueva Contraseña</label>
                <input type="password" class="form-control form-control-lg border-light-subtle bg-light" id="contrasena" name="contrasena" placeholder="Mínimo 6 caracteres">
              </div>
              <div class="col-md-6">
                <label for="contrasena_confirm" class="form-label fw-semibold">Confirmar Nueva Contraseña</label>
                <input type="password" class="form-control form-control-lg border-light-subtle bg-light" id="contrasena_confirm" placeholder="Debe coincidir">
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-5">
              <a href="index.php?action=rescatista" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                <i class="fa-solid fa-arrow-left me-2"></i> Volver al Panel
              </a>
              <button type="submit" class="btn btn-verde px-5 py-2 rounded-3">
                <i class="fa-solid fa-save me-2"></i> Guardar Cambios
              </button>
            </div>
            
          </form>

        </div>
      </div>
    </div>
  </div>
</main>

<script>
document.getElementById('contrasena_confirm').addEventListener('input', function() {
    let password = document.getElementById('contrasena').value;
    if (this.value !== password) {
        this.setCustomValidity('Las contraseñas no coinciden.');
    } else {
        this.setCustomValidity('');
    }
});
</script>

<?php include 'layout/footer.php'; ?>

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
                <input type="text" class="form-control form-control-lg border-light-subtle bg-light" id="nombre"
                  name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
                <div class="invalid-feedback">Por favor ingresa tu nombre.</div>
              </div>
              <div class="col-md-6">
                <label for="apellido" class="form-label fw-semibold">Apellido *</label>
                <input type="text" class="form-control form-control-lg border-light-subtle bg-light" id="apellido"
                  name="apellido" value="<?= htmlspecialchars($usuario['apellido']) ?>" required>
                <div class="invalid-feedback">Por favor ingresa tu apellido.</div>
              </div>
            </div>

            <div class="row g-4 mb-4">
              <div class="col-md-6">
                <label for="correo" class="form-label fw-semibold">Correo Electrónico</label>
                <input type="email" class="form-control form-control-lg border-light-subtle bg-light" id="correo"
                  value="<?= htmlspecialchars($usuario['correo']) ?>" disabled>
                <div class="form-text">El correo electrónico no puede ser modificado.</div>
              </div>
              <div class="col-md-6">
                <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                <input type="text" class="form-control form-control-lg border-light-subtle bg-light" id="telefono"
                  name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">
              </div>
            </div>

            <hr class="my-5 text-light-subtle">

            <h5 class="mb-4 text-navy fw-bold">Cambiar Contraseña</h5>
            <p class="text-muted small mb-4">Si no deseas cambiar tu contraseña, deja estos campos en blanco.</p>

            <div class="row g-4 mb-5">
              <div class="col-md-6">
                <label for="contrasena" class="form-label fw-semibold">Nueva Contraseña</label>
                <input type="password" class="form-control form-control-lg border-light-subtle bg-light" id="contrasena"
                  name="contrasena" placeholder="Mínimo 6 caracteres">
              </div>
              <div class="col-md-6">
                <label for="contrasena_confirm" class="form-label fw-semibold">Confirmar Nueva Contraseña</label>
                <input type="password" class="form-control form-control-lg border-light-subtle bg-light"
                  id="contrasena_confirm" placeholder="Debe coincidir">
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-5">
              <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] == 2): ?>
                <a href="index.php?action=rescatista" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                  <i class="fa-solid fa-arrow-left me-2"></i> Volver al Panel
                </a>
              <?php else: ?>
                <a href="index.php?action=catalogo" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                  <i class="fa-solid fa-paw me-2"></i> Ver Mascotas
                </a>
              <?php endif; ?>
              <button type="submit" class="btn btn-verde px-5 py-2 rounded-3">
                <i class="fa-solid fa-save me-2"></i> Guardar Cambios
              </button>
            </div>

          </form>

        </div>
      </div>

      <!-- cuando es cliente, es el panel para controlar las solicitudes -->
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden mt-5">
        <div class="card-header bg-verde text-white p-4 d-flex justify-content-between align-items-center">
          <h3 class="h5 mb-0 fw-bold"><i class="fa-solid fa-heart me-2"></i> Mis Solicitudes</h3>
          <span
            class="badge bg-white text-verde rounded-pill px-3 py-2 fw-bold"><?= isset($solicitudes) ? count($solicitudes) : 0 ?></span>
        </div>
        <div class="card-body p-4 p-md-5">
          <?php if (empty($solicitudes)): ?>
            <div class="text-center py-5">
              <i class="fa-regular fa-folder-open fs-1 text-muted mb-3 d-block"></i>
              <h5 class="text-secondary fw-semibold">Aún no has enviado solicitudes de adopción</h5>
              <p class="text-muted small mb-4">Cuando te enamores de una mascota en nuestro catálogo y solicites
                adoptarla, podrás ver su estado aquí.</p>
              <a href="index.php?action=catalogo" class="btn btn-outline-verde rounded-pill px-4">Explorar Mascotas</a>
            </div>
          <?php else: ?>
            <div class="list-group list-group-flush">
              <?php foreach ($solicitudes as $sol): ?>
                <div class="list-group-item py-4 px-0 border-light-subtle">
                  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-4">

                    <div class="d-flex align-items-start gap-3">
                      <img src="<?= htmlspecialchars($sol['foto_path'] ?: 'https://via.placeholder.com/150') ?>"
                        class="rounded-3 object-fit-cover shadow-sm" style="width: 85px; height: 85px;"
                        alt="Foto de <?= htmlspecialchars($sol['mascota_nombre']) ?>">
                      <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                          <h5 class="mb-0 fw-bold text-navy"><?= htmlspecialchars($sol['mascota_nombre']) ?></h5>
                          <span
                            class="badge bg-light text-secondary border small"><?= htmlspecialchars($sol['especie'] ?? 'Mascota') ?></span>
                        </div>
                        <p class="text-muted small mb-2">
                          <i class="fa-solid fa-user-shield me-1 text-verde"></i> Rescatista: <span
                            class="fw-semibold text-dark"><?= htmlspecialchars($sol['rescatista_nombre']) ?></span>
                        </p>
                        <div class="p-3 bg-light rounded-3 mt-2 border border-light-subtle">
                          <p class="mb-0 text-dark small fst-italic">"<?= htmlspecialchars($sol['mensaje']) ?>"</p>
                        </div>
                      </div>
                    </div>

                    <div class="text-md-end d-flex flex-column justify-content-between align-items-md-end"
                      style="min-width: 140px;">
                      <?php
                      $badgeClass = 'bg-warning text-dark';
                      $iconoEstado = 'fa-clock';
                      if ($sol['estado_solicitud'] == 'Aprobada') {
                        $badgeClass = 'bg-success text-white';
                        $iconoEstado = 'fa-circle-check';
                      } elseif ($sol['estado_solicitud'] == 'Rechazada') {
                        $badgeClass = 'bg-danger text-white';
                        $iconoEstado = 'fa-circle-xmark';
                      }
                      ?>
                      <div class="mb-2">
                        <span class="badge <?= $badgeClass ?> rounded-pill px-3 py-2 fw-semibold">
                          <i class="fa-solid <?= $iconoEstado ?> me-1"></i>
                          <?= htmlspecialchars($sol['estado_solicitud']) ?>
                        </span>
                      </div>
                      <small class="text-muted">Enviada: <?= date('d M Y', strtotime($sol['fecha_envio'])) ?></small>
                    </div>

                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  document.getElementById('contrasena_confirm').addEventListener('input', function () {
    let password = document.getElementById('contrasena').value;
    if (this.value !== password) {
      this.setCustomValidity('Las contraseñas no coinciden.');
    } else {
      this.setCustomValidity('');
    }
  });
</script>

<?php include 'layout/footer.php'; ?>
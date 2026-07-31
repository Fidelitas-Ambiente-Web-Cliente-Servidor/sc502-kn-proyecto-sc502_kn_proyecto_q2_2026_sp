<?php
$page_title = $mascota ? "Editar Mascota - Huellas Felices" : "Nueva Mascota - Huellas Felices";
include 'layout/header.php';
?>

<main class="container py-5 my-4">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-navy text-white p-4">
          <h2 class="h4 mb-0 fw-bold">
            <i class="fa-solid <?= $mascota ? 'fa-pen-to-square' : 'fa-paw' ?> me-2"></i> 
            <?= $mascota ? 'Editar Mascota' : 'Agregar Nueva Mascota' ?>
          </h2>
        </div>
        <div class="card-body p-4 p-md-5">

          <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
              <i class="fa-solid fa-triangle-exclamation me-2"></i>
              <div>Hubo un error al procesar la solicitud. Por favor revisa los datos e intenta de nuevo.</div>
            </div>
          <?php endif; ?>

          <form action="index.php?action=<?= $accion_form ?>" method="POST" class="needs-validation" novalidate>
            
            <div class="row g-4 mb-4">
              <div class="col-md-6">
                <label for="nombre" class="form-label fw-semibold">Nombre de la Mascota *</label>
                <input type="text" class="form-control form-control-lg border-light-subtle bg-light" id="nombre" name="nombre" value="<?= htmlspecialchars($mascota['nombre'] ?? '') ?>" required>
                <div class="invalid-feedback">Por favor ingresa el nombre de la mascota.</div>
              </div>
              
              <div class="col-md-6">
                <label for="edad" class="form-label fw-semibold">Edad (años) *</label>
                <input type="number" class="form-control form-control-lg border-light-subtle bg-light" id="edad" name="edad" min="0" max="30" value="<?= htmlspecialchars($mascota['edad'] ?? '') ?>" required>
                <div class="invalid-feedback">Por favor ingresa una edad válida.</div>
              </div>
            </div>

            <div class="row g-4 mb-4">
              <div class="col-md-6">
                <label for="especie_id" class="form-label fw-semibold">Especie *</label>
                <select class="form-select form-select-lg border-light-subtle bg-light" id="especie_id" name="especie_id" required>
                  <option value="" disabled <?= !$mascota ? 'selected' : '' ?>>Selecciona una especie</option>
                  <?php foreach ($especies as $especie): ?>
                    <option value="<?= $especie['id'] ?>" <?= ($mascota && $mascota['especie_id'] == $especie['id']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($especie['nombre_especie']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Selecciona una especie.</div>
              </div>

              <div class="col-md-6">
                <label for="raza_id" class="form-label fw-semibold">Raza *</label>
                <select class="form-select form-select-lg border-light-subtle bg-light" id="raza_id" name="raza_id" required>
                  <option value="" disabled <?= !$mascota ? 'selected' : '' ?>>Selecciona una raza</option>
                  <?php foreach ($razas as $raza): ?>
                    <option value="<?= $raza['id'] ?>" <?= ($mascota && $mascota['raza_id'] == $raza['id']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($raza['nombre_raza']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Selecciona una raza.</div>
              </div>
            </div>

            <div class="row g-4 mb-4">
              <div class="col-md-6">
                <label for="tamano_id" class="form-label fw-semibold">Tamaño *</label>
                <select class="form-select form-select-lg border-light-subtle bg-light" id="tamano_id" name="tamano_id" required>
                  <option value="" disabled <?= !$mascota ? 'selected' : '' ?>>Selecciona un tamaño</option>
                  <?php foreach ($tamanos as $tamano): ?>
                    <option value="<?= $tamano['id'] ?>" <?= ($mascota && $mascota['tamano_id'] == $tamano['id']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($tamano['descripcion']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Selecciona un tamaño.</div>
              </div>

              <div class="col-md-6">
                <label for="energia_id" class="form-label fw-semibold">Nivel de Energía *</label>
                <select class="form-select form-select-lg border-light-subtle bg-light" id="energia_id" name="energia_id" required>
                  <option value="" disabled <?= !$mascota ? 'selected' : '' ?>>Selecciona el nivel de energía</option>
                  <?php foreach ($energias as $energia): ?>
                    <option value="<?= $energia['id'] ?>" <?= ($mascota && $mascota['energia_id'] == $energia['id']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($energia['descripcion']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Selecciona el nivel de energía.</div>
              </div>
            </div>

            <div class="row g-4 mb-4">
              <div class="col-12">
                <label for="foto_path" class="form-label fw-semibold">URL de Fotografía *</label>
                <input type="url" class="form-control form-control-lg border-light-subtle bg-light" id="foto_path" name="foto_path" placeholder="https://ejemplo.com/imagen.jpg" value="<?= htmlspecialchars($mascota['foto_path'] ?? '') ?>" required>
                <div class="form-text">Pega un enlace directo a la imagen de la mascota.</div>
                <div class="invalid-feedback">Por favor ingresa una URL válida.</div>
              </div>
            </div>

            <div class="mb-4">
              <label for="historia" class="form-label fw-semibold">Historia / Descripción</label>
              <textarea class="form-control form-control-lg border-light-subtle bg-light" id="historia" name="historia" rows="4" placeholder="Cuéntanos un poco sobre la mascota..."><?= htmlspecialchars($mascota['historia'] ?? '') ?></textarea>
            </div>

            <div class="mb-5">
              <label for="estado" class="form-label fw-semibold">Estado de la Mascota *</label>
              <select class="form-select form-select-lg border-light-subtle bg-light" id="estado" name="estado" required>
                <option value="Disponible" <?= ($mascota && $mascota['estado'] == 'Disponible') ? 'selected' : '' ?>>Disponible</option>
                <option value="Urgente" <?= ($mascota && $mascota['estado'] == 'Urgente') ? 'selected' : '' ?>>Urgente</option>
                <option value="Adoptado" <?= ($mascota && $mascota['estado'] == 'Adoptado') ? 'selected' : '' ?>>Adoptado</option>
              </select>
              <div class="invalid-feedback">Selecciona el estado.</div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-5">
              <a href="index.php?action=rescatista" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                <i class="fa-solid fa-arrow-left me-2"></i> Cancelar
              </a>
              <button type="submit" class="btn btn-verde px-5 py-2 rounded-3">
                <i class="fa-solid fa-save me-2"></i> <?= $mascota ? 'Guardar Cambios' : 'Registrar Mascota' ?>
              </button>
            </div>
            
          </form>

        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'layout/footer.php'; ?>

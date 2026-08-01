<?php
$extra_css = "admin.css";
include 'views/layout/header.php';
?>

<main class="py-5 bg-light-cream">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="fw-bold text-navy mb-0">Editar Raza</h2>
          <a href="index.php?action=admin_razas" class="btn btn-outline-secondary"><i
              class="fa-solid fa-arrow-left me-1"></i> Volver</a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="card-body p-4 p-md-5">
            <form action="index.php?action=admin_editar_raza_post&id=<?= $raza['id'] ?>" method="POST">
              <div class="mb-4">
                <label for="especie_id" class="form-label fw-semibold">Especie</label>
                <select class="form-select form-select-lg border-light-subtle" id="especie_id" name="especie_id" required>
                  <option value="" disabled>Seleccione...</option>
                  <?php foreach($especies as $especie): ?>
                    <option value="<?= $especie['id'] ?>" <?= ($raza['especie_id'] == $especie['id']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($especie['nombre_especie']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-4">
                <label for="nombre_raza" class="form-label fw-semibold">Nombre de la Raza</label>
                <input type="text" class="form-control form-control-lg border-light-subtle" id="nombre_raza"
                  name="nombre_raza" value="<?= htmlspecialchars($raza['nombre_raza']) ?>" required>
              </div>
              <div class="d-grid mt-5">
                <button type="submit" class="btn btn-verde btn-lg rounded-3">
                  <i class="fa-solid fa-save me-2"></i> Guardar Cambios
                </button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>

<?php include 'views/layout/footer.php'; ?>
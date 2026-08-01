<?php
$page_title = "Panel de Administrador - Razas";
$extra_css = "admin.css";
include 'views/layout/header.php';
?>

<main class="py-5 bg-light-cream">
  <div class="container">
    <div class="row g-4">

      <div class="col-lg-3">
        <div class="bg-white rounded-4 shadow-sm p-4 mb-4 border border-light-subtle">
          <h3 class="fw-bold mb-4 text-navy">Admin Panel</h3>
          <nav class="nav flex-column gap-2 mb-0">
            <a href="index.php?action=admin_dashboard" class="nav-link text-dark rounded-3 p-3 d-flex align-items-center side-link">
              <span class="fw-semibold text-secondary"><i class="fa-solid fa-chart-pie me-3"></i>Dashboard</span>
            </a>
            <a href="index.php?action=admin_usuarios" class="nav-link text-dark rounded-3 p-3 d-flex align-items-center side-link">
              <span class="fw-semibold text-secondary"><i class="fa-solid fa-users me-3"></i>Usuarios</span>
            </a>
            <a href="index.php?action=admin_mascotas" class="nav-link text-dark rounded-3 p-3 d-flex align-items-center side-link">
              <span class="fw-semibold text-secondary"><i class="fa-solid fa-paw me-3"></i>Mascotas</span>
            </a>
            <a href="index.php?action=admin_razas" class="nav-link active rounded-3 p-3 d-flex align-items-center side-link">
              <span class="fw-semibold"><i class="fa-solid fa-dog me-3"></i>Razas</span>
            </a>
          </nav>
        </div>
      </div>

      <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
          <div>
            <h2 class="fw-bold mb-1 text-navy">Gestión de Razas</h2>
            <p class="text-secondary mb-0">Añade razas nuevas para que los rescatistas puedan usarlas.</p>
          </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
          <div class="card-body p-4">
            <form action="index.php?action=admin_crear_raza" method="POST" class="row g-3 align-items-end">
              <div class="col-md-5">
                <label for="especie_id" class="form-label fw-semibold">Especie</label>
                <select class="form-select form-select-lg border-light-subtle" id="especie_id" name="especie_id" required>
                  <option value="" selected disabled>Seleccione...</option>
                  <?php foreach($especies as $especie): ?>
                    <option value="<?= $especie['id'] ?>"><?= htmlspecialchars($especie['nombre_especie']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-5">
                <label for="nombre_raza" class="form-label fw-semibold">Nombre de la Nueva Raza</label>
                <input type="text" class="form-control form-control-lg border-light-subtle" id="nombre_raza" name="nombre_raza" required placeholder="Ej. Golden Retriever">
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-verde btn-lg w-100 rounded-3">
                  <i class="fa-solid fa-plus me-2"></i> Añadir
                </button>
              </div>
            </form>
          </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0 custom-table">
                <thead class="table-light text-secondary">
                  <tr>
                    <th class="ps-4 py-3 fw-semibold text-uppercase font-xs">ID</th>
                    <th class="py-3 fw-semibold text-uppercase font-xs">Especie</th>
                    <th class="py-3 fw-semibold text-uppercase font-xs">Nombre de la Raza</th>
                    <th class="text-end pe-4 py-3 fw-semibold text-uppercase font-xs">Acciones</th>
                  </tr>
                </thead>
                <tbody class="border-top-0">
                  <?php if (empty($razas)): ?>
                    <tr>
                      <td colspan="4" class="text-center py-5 text-muted">No hay razas registradas.</td>
                    </tr>
                  <?php else: ?>
                    <?php foreach ($razas as $raza): ?>
                      <tr>
                        <td class="ps-4">
                          <span class="fw-semibold text-secondary">#<?= $raza['id'] ?></span>
                        </td>
                        <td>
                          <span class="badge bg-light text-secondary border"><?= htmlspecialchars($raza['nombre_especie'] ?? 'Desconocida') ?></span>
                        </td>
                        <td>
                          <p class="mb-0 fw-bold text-dark"><?= htmlspecialchars($raza['nombre_raza']) ?></p>
                        </td>
                        <td class="text-end pe-4">
                          <a href="index.php?action=admin_editar_raza&id=<?= $raza['id'] ?>" class="btn btn-light btn-sm rounded-circle border border-light-subtle me-1" title="Editar">
                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                          </a>
                          <a href="index.php?action=admin_eliminar_raza&id=<?= $raza['id'] ?>" class="btn btn-light btn-sm rounded-circle border border-light-subtle" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta raza? Se recomienda precaución si ya hay mascotas que la utilizan.')">
                            <i class="fa-solid fa-trash text-danger"></i>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>

<?php include 'views/layout/footer.php'; ?>

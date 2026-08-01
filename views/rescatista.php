<?php
$page_title = "Huellas Felices - Panel Rescatista";
$extra_css = "rescatista.css";
include 'layout/header.php';
?>

<main class="py-5 bg-light-cream">
  <div class="container">
    <div class="row g-4">

      <div class="col-lg-3">
        <div class="bg-white rounded-4 shadow-sm p-4 mb-4 border border-light-subtle">
          <h3 class="fw-bold mb-4 text-verde">Hola, Elena</h3>

          <nav class="nav flex-column gap-2 mb-0">
            <a href="index.php?action=rescatista&tab=mascotas"
              class="nav-link <?= (!isset($_GET['tab']) || $_GET['tab'] == 'mascotas') ? 'active' : 'text-dark' ?> rounded-3 p-3 d-flex justify-content-between align-items-center side-link">
              <span class="fw-semibold"><i class="fa-solid fa-paw me-3"></i>Mis Mascotas</span>
              <span class="badge rounded-pill"><?= count($mascotas) ?></span>
            </a>
            <a href="index.php?action=rescatista&tab=solicitudes"
              class="nav-link <?= (isset($_GET['tab']) && $_GET['tab'] == 'solicitudes') ? 'active' : 'text-dark' ?> rounded-3 p-3 d-flex justify-content-between align-items-center side-link">
              <span class="fw-semibold <?= (isset($_GET['tab']) && $_GET['tab'] == 'solicitudes') ? '' : 'text-secondary' ?>"><i class="fa-regular fa-file-lines me-3"></i>Solicitudes</span>
              <span class="badge rounded-pill badge-orange"><?= count($solicitudes) ?></span>
            </a>
          </nav>
        </div>

        <div class="row g-3">
          <div class="col-6">
            <div class="bg-white rounded-4 shadow-sm p-3 border border-light-subtle text-center h-100">
              <p class="text-muted small fw-semibold mb-1">Adoptados</p>
              <h2 class="fw-bold text-verde mb-0"><?= $mascotasAdoptadas ?></h2>
            </div>
          </div>
          <div class="col-6">
            <div class="bg-white rounded-4 shadow-sm p-3 border border-light-subtle text-center h-100">
              <p class="text-muted small fw-semibold mb-1">Disponibles</p>
              <h2 class="fw-bold mb-0 text-orange"><?= $mascotasDisponibles ?></h2>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-9">
        <?php if (!isset($_GET['tab']) || $_GET['tab'] == 'mascotas'): ?>
          <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
              <h2 class="fw-bold mb-1 text-navy">Gestion de Mascotas</h2>
              <p class="text-secondary mb-0">Administra los perfiles de los animales rescatados.</p>
            </div>
            <a href="index.php?action=mascota_crear" class="btn btn-verde d-flex align-items-center gap-2">
              <i class="fa-solid fa-plus"></i> Agregar Mascota
            </a>
          </div>

        <!--  Card -->
        <div class="bg-white rounded-4 shadow-sm border border-light-subtle overflow-hidden">
          <div
            class="p-4 border-bottom border-light-subtle d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="position-relative flex-grow-1 search-bar-mw">
              <i
                class="fa-solid fa-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
              <input type="text"
                class="form-control form-control-lg rounded-pill ps-5 bg-transparent border-light-subtle"
                placeholder="Buscar por nombre o especie...">
            </div>
            <button
              class="btn btn-light rounded-pill px-4 border-light-subtle fw-semibold text-secondary d-flex align-items-center gap-2">
              <i class="fa-solid fa-filter"></i> Filtros
            </button>
          </div>

          <!-- Table -->
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 table-responsive-min">
              <thead class="bg-soft-gray text-muted small text-uppercase">
                <tr>
                  <th class="ps-4 py-3 fw-semibold border-0">Mascota</th>
                  <th class="py-3 fw-semibold border-0">Estado</th>
                  <th class="py-3 fw-semibold border-0">Fecha Registro</th>
                  <th class="pe-4 py-3 fw-semibold border-0 text-end">Acciones</th>
                </tr>
              </thead>
              <tbody class="border-top-0">

                <?php if (empty($mascotas)): ?>
                  <tr>
                    <td colspan="4" class="text-center py-5 text-muted">Aún no tienes mascotas registradas.</td>
                  </tr>
                <?php else: ?>
                  <?php foreach ($mascotas as $mascota): ?>
                    <tr>
                      <td class="ps-4 py-3">
                        <div class="d-flex align-items-center gap-3">
                          <img src="<?= htmlspecialchars($mascota['foto_path'] ?: 'https://via.placeholder.com/150') ?>"
                            alt="" class="rounded-3 object-fit-cover avatar-md" style="width: 50px; height: 50px;">
                          <div>
                            <h6 class="mb-0 fw-bold text-dark"><?= htmlspecialchars($mascota['nombre']) ?></h6>
                            <small class="text-muted"><?= htmlspecialchars($mascota['nombre_especie']) ?> •
                              <?= $mascota['edad'] ?> años</small>
                          </div>
                        </div>
                      </td>
                      <td class="py-3">
                          <?php
                          $badgeClass = '';
                          if ($mascota['estado'] == 'Disponible')
                            $badgeClass = 'bg-success';
                          else if ($mascota['estado'] == 'Urgente')
                            $badgeClass = 'bg-danger';
                          else
                            $badgeClass = 'bg-secondary';
                          ?>
                        <span
                          class="badge rounded-pill fw-semibold <?= $badgeClass ?>"><?= htmlspecialchars($mascota['estado']) ?></span>
                      </td>
                      <td class="py-3 text-secondary">
                          <?= date('d M Y', strtotime($mascota['fecha_publicacion'])) ?>
                      </td>
                      <td class="pe-4 py-3 text-end">
                        <a href="index.php?action=mascota_editar&id=<?= $mascota['id'] ?>"
                          class="btn btn-sm btn-link text-verde p-0 me-3 fs-5" title="Editar"><i
                            class="fa-solid fa-pen"></i></a>
                        <a href="index.php?action=mascota_eliminar&id=<?= $mascota['id'] ?>"
                          class="btn btn-sm btn-link text-warning p-0 fs-5" title="Eliminar"
                          onclick="return confirm('¿Estás seguro de que deseas eliminar esta mascota?');"><i
                            class="fa-regular fa-trash-can"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>

            <div class="p-4 border-top border-light-subtle d-flex justify-content-between align-items-center">
              <span class="text-muted small fw-semibold">Mostrando 1-3 de 12 mascotas</span>
              <div class="d-flex gap-2">
                <button
                  class="btn btn-light rounded-circle border-light-subtle d-flex align-items-center justify-content-center btn-pagination"><i
                    class="fa-solid fa-chevron-left"></i></button>
                <button
                  class="btn rounded-circle d-flex align-items-center justify-content-center btn-pagination active">1</button>
                <button
                  class="btn btn-light rounded-circle border-light-subtle d-flex align-items-center justify-content-center fw-semibold text-secondary btn-pagination">2</button>
                <button
                  class="btn btn-light rounded-circle border-light-subtle d-flex align-items-center justify-content-center btn-pagination"><i
                    class="fa-solid fa-chevron-right"></i></button>
              </div>
            </div>
          </div>
        </div>

        <?php elseif ($_GET['tab'] == 'solicitudes'): ?>

          <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
              <h2 class="fw-bold mb-1 text-navy">Solicitudes de Adopción</h2>
              <p class="text-secondary mb-0">Gestiona las solicitudes enviadas por los adoptantes.</p>
            </div>
          </div>
          
          <div class="bg-white rounded-4 shadow-sm border border-light-subtle overflow-hidden p-4">
            <?php if (empty($solicitudes)): ?>
              <p class="text-center text-muted py-5 mb-0">Aún no has recibido ninguna solicitud de adopción.</p>
            <?php else: ?>
              <div class="list-group list-group-flush">
                <?php foreach ($solicitudes as $sol): ?>
                  <div class="list-group-item py-4 px-0 border-light-subtle">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-4">
                      
                      <div class="d-flex align-items-start gap-3">
                        <img src="<?= htmlspecialchars($sol['foto_path'] ?: 'https://via.placeholder.com/150') ?>" class="rounded-3 object-fit-cover" style="width: 80px; height: 80px;">
                        <div>
                          <h5 class="mb-1 fw-bold text-navy"><?= htmlspecialchars($sol['mascota_nombre']) ?></h5>
                          <p class="text-muted small mb-2"><i class="fa-regular fa-user me-1"></i> De: <span class="fw-semibold text-dark"><?= htmlspecialchars($sol['adoptante_nombre'] . ' ' . $sol['adoptante_apellido']) ?></span> (<?= htmlspecialchars($sol['adoptante_correo']) ?>) <br><i class="fa-solid fa-phone me-1 mt-1"></i> <?= htmlspecialchars($sol['adoptante_telefono']) ?></p>
                          <div class="p-3 bg-light rounded-3 mt-2">
                            <p class="mb-0 text-dark small fst-italic">"<?= htmlspecialchars($sol['mensaje']) ?>"</p>
                          </div>
                        </div>
                      </div>
                      
                      <div class="text-md-end d-flex flex-column justify-content-between align-items-md-end" style="min-width: 150px;">
                        <?php 
                          $estadoBadge = 'bg-warning text-dark';
                          if ($sol['estado_solicitud'] == 'Aprobada') $estadoBadge = 'bg-success';
                          if ($sol['estado_solicitud'] == 'Rechazada') $estadoBadge = 'bg-danger';
                        ?>
                        <div class="mb-3">
                          <span class="badge <?= $estadoBadge ?> rounded-pill mb-1 px-3 py-2"><?= htmlspecialchars($sol['estado_solicitud']) ?></span><br>
                          <small class="text-muted"><?= date('d M Y', strtotime($sol['fecha_envio'])) ?></small>
                        </div>
                        
                        <?php if ($sol['estado_solicitud'] == 'Pendiente'): ?>
                          <div class="d-flex gap-2 w-100 justify-content-md-end mt-2 mt-md-0">
                            <form action="index.php?action=solicitud_estado" method="POST" class="w-100 w-md-auto">
                              <input type="hidden" name="solicitud_id" value="<?= $sol['solicitud_id'] ?>">
                              <input type="hidden" name="estado" value="Aprobada">
                              <button type="submit" class="btn btn-sm btn-outline-success rounded-pill fw-semibold px-3 w-100">Aprobar</button>
                            </form>
                            <form action="index.php?action=solicitud_estado" method="POST" class="w-100 w-md-auto">
                              <input type="hidden" name="solicitud_id" value="<?= $sol['solicitud_id'] ?>">
                              <input type="hidden" name="estado" value="Rechazada">
                              <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill fw-semibold px-3 w-100">Rechazar</button>
                            </form>
                          </div>
                        <?php endif; ?>
                      </div>

                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

        <?php endif; ?>

      </div>
    </div>
</main>

<?php include 'layout/footer.php'; ?>
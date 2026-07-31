<?php
$page_title = "Huellas Felices - CatÃ¡logo";
$extra_css = "index.css";
include 'layout/header.php';
?>

<main class="container py-5">
  <div class="row g-4">

    <aside class="col-lg-3">
      <div class="filtros-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="h5 fw-bold mb-0"><i class="fa-solid fa-sliders text-verde me-2"></i>Filtros</h3>
          <i class="fa-solid fa-paw text-muted"></i>
        </div>

        <hr class="mb-4">

        <!-- Filtros -->
        <div class="filtro-seccion">
          <h4 class="filtro-titulo">Especie</h4>
          <label class="filtro-opcion">
            <input type="checkbox" class="filtro-chk" data-tipo="especie" value="perro"> Perros
          </label>
          <label class="filtro-opcion">
            <input type="checkbox" class="filtro-chk" data-tipo="especie" value="gato"> Gatos
          </label>
        </div>
        <!-- estado -->
        <div class="filtro-seccion">
          <h4 class="filtro-titulo">Estado</h4>
          <label class="filtro-opcion">
            <input type="checkbox" class="filtro-chk" data-tipo="estado" value="disponible"> Disponible
          </label>
          <label class="filtro-opcion">
            <input type="checkbox" class="filtro-chk" data-tipo="estado" value="urgente"> Urgente
          </label>
        </div>
        <button class="btn btn-outline-verde w-100 mt-3" type="button" id="btn-clear-filters">Limpiar Filtros</button>
      </div>
    </aside>

    <section class="col-lg-9">
      <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
          <h1 class="h2 fw-bold mb-1">Amigos esperando por ti</h1>
          <p class="text-muted mb-0">Conoce a las mascotas que buscan un hogar hoy</p>
        </div>
        <!-- ordenar -->
        <div class="d-flex align-items-center gap-2">
          <span class="text-secondary small text-nowrap">Ordenar por:</span>
          <select class="form-select border-0 bg-white shadow-sm ordenar-select">
            <option value="recientes" selected>Recientes</option>
            <option value="nombre">Nombre</option>
          </select>
        </div>
      </div>

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <?php foreach ($mascotas as $mascota): ?>
        <div class="col mascota-item" data-especie="<?= htmlspecialchars(strtolower($mascota['nombre_especie'] ?? '')) ?>" data-estado="<?= htmlspecialchars(strtolower($mascota['estado'] ?? '')) ?>">
          <div class="mascota-card">
            <div class="mascota-img-container">
              <?php if($mascota['estado'] == 'Urgente'): ?>
              <span class="mascota-badge bg-warning text-dark">Urgente</span>
              <?php else: ?>
              <span class="mascota-badge mascota-badge-verde">Nuevo</span>
              <?php endif; ?>
              <img src="<?= htmlspecialchars($mascota['foto_path'] ?: 'https://via.placeholder.com/300') ?>" alt="<?= htmlspecialchars($mascota['nombre']) ?>" class="mascota-img">
              <button class="like-btn" title="Guardar"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="mascota-card-body">
              <h4 class="fw-bold h5 mb-2"><?= htmlspecialchars($mascota['nombre']) ?></h4>
              <div class="mascota-info-row">
                <span><i class="fa-solid fa-calendar me-1"></i> <?= htmlspecialchars($mascota['edad']) ?> meses</span>
                <span>&bull;</span>
                <span><i class="fa-solid fa-weight-hanging me-1"></i> <?= htmlspecialchars($mascota['tamano']) ?></span>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="mascota-energia-tag <?= $mascota['energia_id'] == 1 ? 'energia-baja' : '' ?>"><?= htmlspecialchars($mascota['energia']) ?></span>
                <a href="index.php?action=mascota&id=<?= $mascota['id'] ?>" class="btn btn-sm btn-outline-verde px-3 py-1">Conocer</a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Paginador del catalogo -->
        <nav class="d-flex justify-content-center mt-5">
          <div class="d-flex gap-2">
            <button class="btn btn-light rounded-circle border-light-subtle d-flex align-items-center justify-content-center btn-pagination"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="btn rounded-circle d-flex align-items-center justify-content-center btn-pagination active">1</button>
            <button class="btn btn-light rounded-circle border-light-subtle d-flex align-items-center justify-content-center fw-semibold text-secondary btn-pagination">2</button>
            <button class="btn btn-light rounded-circle border-light-subtle d-flex align-items-center justify-content-center fw-semibold text-secondary btn-pagination">3</button>
            <button class="btn btn-link rounded-circle d-flex align-items-center justify-content-center fw-semibold text-secondary text-decoration-none bg-transparent border-0" disabled>...</button>
            <button class="btn btn-light rounded-circle border-light-subtle d-flex align-items-center justify-content-center fw-semibold text-secondary btn-pagination">8</button>
            <button class="btn btn-light rounded-circle border-light-subtle d-flex align-items-center justify-content-center btn-pagination"><i class="fa-solid fa-chevron-right"></i></button>
          </div>
        </nav>

    </section>

  </div>
</main>

<?php include 'layout/footer.php'; ?>
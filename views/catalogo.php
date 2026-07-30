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
        <!-- esto despues va a ser manejado por js -->
        <div class="filtro-seccion">
          <h4 class="filtro-titulo">Tamaño</h4>
          <label class="filtro-opcion">
            <input type="checkbox" name="tamano" value="pequeno"> Pequeño
          </label>
          <label class="filtro-opcion">
            <input type="checkbox" name="tamano" value="mediano" checked> Mediano
          </label>
          <label class="filtro-opcion">
            <input type="checkbox" name="tamano" value="grande"> Grande
          </label>
        </div>
        <!-- energia -->
        <div class="filtro-seccion">
          <h4 class="filtro-titulo">Nivel de Energía</h4>
          <label class="filtro-opcion">
            <input type="radio" name="energia" value="bajo"> Bajo
          </label>
          <label class="filtro-opcion">
            <input type="radio" name="energia" value="medio" checked> Medio
          </label>
          <label class="filtro-opcion">
            <input type="radio" name="energia" value="alto"> Alto
          </label>
        </div>
        <!-- edad -->
        <div class="filtro-seccion">
          <h4 class="filtro-titulo">Edad</h4>
          <select class="form-select border-2 filtro-edad-select" id="filtro-edad">
            <option value="" disabled>Seleccione edad...</option>
            <option value="cachorro">Cachorro</option>
            <option value="joven">Joven</option>
            <option value="adulto" selected>Adulto</option>
            <option value="senior">Senior</option>
          </select>
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
        <div class="col">
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



        <!-- Paginador del catalogo -->
        <nav class="d-flex justify-content-center mt-5">
          <ul class="pagination gap-2 border-0">
            <li class="page-item">
              <a class="page-link border-0 rounded-circle d-flex align-items-center justify-content-center shadow-sm paginador-btn"
                href="#"><i class="fa-solid fa-chevron-left"></i></a>
            </li>
            <li class="page-item"><a
                class="page-link border-0 rounded-circle d-flex align-items-center justify-content-center shadow-sm paginador-btn active"
                href="#">1</a></li>
            <li class="page-item"><a
                class="page-link border-0 rounded-circle d-flex align-items-center justify-content-center shadow-sm paginador-btn"
                href="#">2</a></li>
            <li class="page-item"><a
                class="page-link border-0 rounded-circle d-flex align-items-center justify-content-center shadow-sm paginador-btn"
                href="#">3</a></li>
            <li class="page-item disabled"><span
                class="page-link border-0 d-flex align-items-center justify-content-center paginador-separator">...</span>
            </li>
            <li class="page-item"><a
                class="page-link border-0 rounded-circle d-flex align-items-center justify-content-center shadow-sm paginador-btn"
                href="#">8</a></li>
            <li class="page-item">
              <a class="page-link border-0 rounded-circle d-flex align-items-center justify-content-center shadow-sm paginador-btn"
                href="#"><i class="fa-solid fa-chevron-right"></i></a>
            </li>
          </ul>
        </nav>

    </section>

  </div>
</main>

<?php include 'layout/footer.php'; ?>
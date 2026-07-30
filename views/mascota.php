<?php
$page_title = "Huellas Felices - Detalle de Mascota";
$extra_css = "mascota.css";
include 'layout/header.php';
?>

<main class="py-4">
  <div class="container">
    <div class="mb-4">
      <a href="index.php?action=catalogo" class="text-verde text-decoration-none fw-semibold">
        <i class="fa-solid fa-arrow-left me-2"></i>Volver al catálogo
      </a>
    </div>

    <div class="row g-5">
      <div class="col-lg-7">
        <!-- Galeria -->
        <div class="mascota-galeria mb-5">
          <div class="main-photo-container position-relative mb-3">
            <img src="" alt="Nombre de un perro" class="img-fluid rounded-4 w-100 object-fit-cover mascota-img-main">
            <span
              class="badge bg-white text-dark position-absolute bottom-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm fw-semibold">1
              / 4 fotos</span>
          </div>
          <div class="row g-2">
            <div class="col-3">
              <img src="" alt="Miniatura 1"
                class="img-fluid rounded-3 active-thumb w-100 object-fit-cover mascota-img-thumb">
            </div>
            <div class="col-3">
              <img src="" alt="Miniatura 2"
                class="img-fluid rounded-3 opacity-75 w-100 object-fit-cover mascota-img-thumb">
            </div>
            <div class="col-3">
              <img src="" alt="Miniatura 3"
                class="img-fluid rounded-3 opacity-75 w-100 object-fit-cover mascota-img-thumb">
            </div>
            <div class="col-3 position-relative">
              <img src="" alt="Miniatura 4"
                class="img-fluid rounded-3 opacity-75 w-100 object-fit-cover mascota-img-thumb">
              <div
                class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center mascota-thumb-overlay">
                <span class="fw-bold text-dark fs-5">+1</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Historia -->
        <div class="mascota-historia bg-soft-gray p-4 p-md-5 rounded-4 mb-4">
          <h3 class="fw-bold mb-4 text-dark-navy">Historia de <?= htmlspecialchars($mascota['nombre']) ?></h3>
          <p class="text-secondary mb-4 fs-5 mascota-historia-text">
            <?= htmlspecialchars($mascota['historia']) ?>
          </p>
        </div>
      </div>

      <!-- Derecha: Detalles y Formulario -->
      <div class="col-lg-5">
        <div class="d-flex justify-content-between align-items-start mb-2">
          <div>
            <h1 class="fw-extrabold mb-1 text-dark-navy mascota-title-lg"><?= htmlspecialchars($mascota['nombre']) ?>
            </h1>
            <p class="text-verde mb-4 fw-semibold"><i class="fa-solid fa-location-dot me-2"></i>Esperando adopción</p>
          </div>
          <button class="btn btn-light rounded-circle shadow-sm btn-icon-lg"><i
              class="fa-regular fa-heart fs-4"></i></button>
        </div>

        <div class="row g-3 mb-5">
          <div class="col-6">
            <div class="spec-card p-3 rounded-3 bg-soft-gray">
              <small class="text-muted text-uppercase fw-semibold mb-1 d-block">Edad</small>
              <p class="mb-0 fw-medium fs-5 text-dark-navy"><?= htmlspecialchars($mascota['edad']) ?> meses</p>
            </div>
          </div>
          <div class="col-6">
            <div class="spec-card p-3 rounded-3 bg-soft-gray">
              <small class="text-muted text-uppercase fw-semibold mb-1 d-block">Raza</small>
              <p class="mb-0 fw-medium fs-5 text-dark-navy"><?= htmlspecialchars($mascota['nombre_raza']) ?></p>
            </div>
          </div>
          <div class="col-6">
            <div class="spec-card p-3 rounded-3 bg-soft-gray">
              <small class="text-muted text-uppercase fw-semibold mb-1 d-block">Tamaño</small>
              <p class="mb-0 fw-medium fs-5 text-dark-navy"><?= htmlspecialchars($mascota['tamano']) ?></p>
            </div>
          </div>
          <div class="col-6">
            <div class="spec-card p-3 rounded-3 bg-soft-gray">
              <small class="text-warning text-uppercase fw-semibold mb-1 d-block">Energía</small>
              <p class="mb-0 fw-medium fs-5 text-dark-navy"><?= htmlspecialchars($mascota['energia']) ?></p>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form-card p-4 p-md-5 rounded-4 shadow-sm bg-white">
          <h4 class="fw-bold mb-3 text-dark-navy">Formulario de Contacto</h4>
          <p class="text-muted mb-4">¿Quieres conocer a Bruno? Envíanos un mensaje al rescatista.</p>

          <form>
            <div class="mb-4">
              <label class="form-label text-muted small fw-semibold">Nombre Completo</label>
              <input type="text" class="form-control form-control-lg rounded-3 border-light-subtle form-control-light"
                placeholder="Ej. Maria Garcia">
            </div>
            <div class="mb-4">
              <label class="form-label text-muted small fw-semibold">Correo Electrónico</label>
              <input type="email" class="form-control form-control-lg rounded-3 border-light-subtle form-control-light"
                placeholder="maria@ejemplo.com">
            </div>
            <div class="mb-4">
              <label class="form-label text-muted small fw-semibold">Mensaje para el Rescatista</label>
              <textarea class="form-control form-control-lg rounded-3 border-light-subtle form-control-light" rows="4"
                placeholder="Cuéntanos un poco sobre tu hogar..."></textarea>
            </div>
            <button type="submit"
              class="btn btn-verde w-100 btn-lg mb-4 rounded-3 d-flex justify-content-center align-items-center gap-2">
              Enviar Solicitud <i class="fa-regular fa-paper-plane"></i>
            </button>
          </form>

          <hr class="border-light-subtle my-4">

          <div class="d-flex align-items-center gap-3">
            <img src="" alt="" class="rounded-circle object-fit-cover avatar-md">
            <div>
              <p class="mb-0 text-muted small">Rescatista: <span
                  class="fw-bold text-dark"><?= htmlspecialchars($mascota['rescatista_nombre']) ?></span></p>
              <p class="mb-0 text-verde small fw-semibold">Contacto:
                <?= htmlspecialchars($mascota['rescatista_telefono']) ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'layout/footer.php'; ?>
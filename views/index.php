<?php
$page_title = "Huellas Felices - Inicio";
$extra_css = "index.css";
include 'layout/header.php';
?>

<main>
  <!-- hero de la pagina -->
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6 text-center text-lg-start">
          <span class="badge-info mb-3">Encuentra a tu mejor amigo <i
              class="fa-solid fa-heart ms-1 text-danger"></i></span>
          <h1 class="hero-title fw-extrabold text-navy">
            Cada huella cuenta <br>una <span>historia de amor</span>.
          </h1>
          <p class="lead mb-4 text-secondary">
            Únete a nuestra comunidad de rescatistas y adoptantes. Juntos, transformamos vidas peludas en hogares
            llenos de alegria y cariño.
          </p>
          <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
            <a href="index.php?action=catalogo" class="btn btn-mustard"><i
                class="fa-solid fa-magnifying-glass me-2"></i>Adoptar
              Ahora</a>
            <a href="index.php?action=login" class="btn btn-outline-verde"><i
                class="fa-solid fa-house-chimney-medical me-2"></i>¿Eres rescatista?</a>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="hero-img-container">
            <!-- aqui va la foto -->
            <img src="" alt="Mujer feliz con su perro" class="hero-img img-fluid">
            <div class="hero-stats-badge">
              <i class="fa-solid fa-circle-check fs-3"></i>
              <div>
                <h6 class="mb-0 fw-bold">+500 Mascotas</h6>
                <p class="small text-muted mb-0">adoptadas este año</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- section ecplicaacion de la pagina -->
  <section class="py-5 bg-white border-top border-bottom border-light">
    <div class="container py-4">
      <div class="text-center mb-5">
        <h2 class="fw-bold">¿Cómo funciona Huellas Felices?</h2>
        <p class="text-secondary max-w-600 mx-auto">Nuestro proceso es simple, transparente y diseñado para asegurar
          que cada mascota encuentre el hogar perfecto.</p>
      </div>
      <div class="row g-4">
        <!-- Paso 1 -->
        <div class="col-md-4">
          <div class="pasos-card text-center">
            <div class="icon-box mx-auto">
              <i class="fa-solid fa-magnifying-glass-paw"></i>
            </div>
            <h4 class="fw-bold h5">1. Busca y Explora</h4>
            <p class="text-muted small mb-0">Filtra por especie, tamaño, edad y personalidad en nuestro catálogo
              interactivo para encontrar a tu compañero ideal.</p>
          </div>
        </div>
        <!-- Paso 2 -->
        <div class="col-md-4">
          <div class="pasos-card text-center">
            <div class="icon-box mx-auto">
              <i class="fa-solid fa-file-invoice"></i>
            </div>
            <h4 class="fw-bold h5">2. Conoce su Historia</h4>
            <p class="text-muted small mb-0">Lee sobre su pasado, necesidades mÃ©dicas y carÃ¡cter en su expediente
              detallado. Ponte en contacto con su rescatista de inmediato.</p>
          </div>
        </div>
        <!-- Paso 3 -->
        <div class="col-md-4">
          <div class="pasos-card text-center">
            <div class="icon-box mx-auto">
              <i class="fa-solid fa-house-circle-check"></i>
            </div>
            <h4 class="fw-bold h5">3. ¡Bienvenido a Casa!</h4>
            <p class="text-muted small mb-0">Completa el formulario de adopción directa del perfil y prepárate para
              recibir al nuevo integrante de tu familia con los brazos abiertos.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- resumen de perros -->
  <section class="py-5">
    <div class="container py-4">
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-5">
        <div>
          <h2 class="fw-bold mb-2">Conoce a nuestros residentes</h2>
          <p class="text-secondary mb-0">PequeÃ±os corazones esperando una oportunidad.</p>
        </div>
        <a href="index.php?action=catalogo" class="btn btn-outline-verde mt-3 mt-md-0">Ver catalogo <i
            class="fa-solid fa-arrow-right ms-1"></i></a>
      </div>

      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="mascota-card">
            <div class="mascota-img-container">
              <span class="mascota-badge mascota-badge-verde">Nuevo</span>
              <img src="" alt="Max Perro" class="mascota-img">
              <button class="like-btn" title="Guardar"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="mascota-card-body">
              <h4 class="fw-bold h5 mb-2">Max</h4>
              <div class="mascota-info-row">
                <span><i class="fa-solid fa-dog me-1"></i> Joven</span>
                <span>&bull;</span>
                <span>Mediano</span>
              </div>
              <p class="text-muted small mb-3">Un compañero leal que ama las caminatas largas y correr en el parque.
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="mascota-energia-tag">Energía Alta</span>
                <a href="index.php?action=mascota" class="btn btn-sm btn-outline-verde px-3 py-1">Ver Mascota</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="mascota-card">
            <div class="mascota-img-container">
              <img src="" alt="Luna Gato" class="mascota-img">
              <button class="like-btn" title="Guardar"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="mascota-card-body">
              <h4 class="fw-bold h5 mb-2">Luna</h4>
              <div class="mascota-info-row">
                <span><i class="fa-solid fa-cat me-1"></i> Adulto</span>
                <span>&bull;</span>
                <span>Pequeña</span>
              </div>
              <p class="text-muted small mb-3">La reina del sofá. Tranquila, cariñosa y amante de las siestas largas
                al sol.</p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="mascota-energia-tag energia-baja">Energía Baja</span>
                <a href="index.php?action=mascota" class="btn btn-sm btn-outline-verde px-3 py-1">Ver Mascota</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="mascota-card">
            <div class="mascota-img-container">
              <span class="mascota-badge bg-warning text-dark">Urgente</span>
              <img src="" alt="Pipo Perro" class="mascota-img">
              <button class="like-btn" title="Guardar"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="mascota-card-body">
              <h4 class="fw-bold h5 mb-2">Pipo</h4>
              <div class="mascota-info-row">
                <span><i class="fa-solid fa-dog me-1"></i> Cachorro</span>
                <span>&bull;</span>
                <span>Mini</span>
              </div>
              <p class="text-muted small mb-3">Pequeño en tamaño pero grande en personalidad. Juguetón y súper
                sociable.</p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="mascota-energia-tag">Energía Media</span>
                <a href="index.php?action=mascota" class="btn btn-sm btn-outline-verde px-3 py-1">Ver Mascota</a>
              </div>
            </div>
          </div>
        </div>
  </section>


  <!-- footer -->

  <?php include 'layout/footer.php'; ?>
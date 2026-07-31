<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($page_title) ? $page_title : 'Huellas Felices'; ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <?php if (isset($extra_css)): ?>
    <link rel="stylesheet" href="css/<?php echo $extra_css; ?>">
  <?php endif; ?>
</head>

<body>
  <nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.php?action=index">
        <i class="fa-solid fa-paw"></i> Huellas Felices
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto align-items-center mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=index">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?action=catalogo">Catálogo</a>
          </li>
          <?php if (!isset($_SESSION['usuario_id'])): ?>
            <li class="nav-item" id="nav-login">
              <a class="nav-link" href="index.php?action=login">Iniciar Sesión</a>
            </li>
            <!-- proteccion del menu, solo el usuario no logueado -->
          <?php else: ?>
            <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] == 2): ?>
              <li class="nav-item" id="nav-dashboard">
                <a class="nav-link" href="index.php?action=rescatista"><i class="fa-solid fa-gauge-high"></i> Panel
                  Rescatista</a>
              </li>
            <?php endif; ?>
          <?php endif; ?>
          <li class="nav-item ms-lg-3" id="nav-adopt-btn">
            <a class="btn btn-verde" href="index.php?action=catalogo">Adoptar Ahora</a>
          </li>

          <?php if (isset($_SESSION['usuario_id'])): ?>
            <!-- usuario logueado -->
            <li class="nav-item dropdown" id="nav-user-menu">
              <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user-circle fs-4 text-verde"></i>
                <span><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] == 2): ?>
                  <li><a class="dropdown-item" href="index.php?action=rescatista"><i class="fa-solid fa-list-check me-2"></i> Mis Mascotas</a></li>
                  <li><a class="dropdown-item" href="index.php?action=rescatista&tab=solicitudes"><i class="fa-solid fa-envelope-open-text me-2"></i> Solicitudes Recibidas</a></li>
                <?php endif; ?>
                <li><a class="dropdown-item" href="index.php?action=perfil"><i class="fa-solid fa-heart me-2 text-verde"></i> Mis Solicitudes</a></li>
                <li><a class="dropdown-item" href="index.php?action=perfil"><i class="fa-solid fa-user-pen me-2"></i> Mi
                    Perfil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-danger" href="index.php?action=logout" id="btn-logout-click"><i
                      class="fa-solid fa-right-from-bracket me-2"></i> Cerrar Sesión</a></li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
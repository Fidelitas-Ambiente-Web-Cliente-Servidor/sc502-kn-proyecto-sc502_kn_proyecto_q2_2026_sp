<?php
include 'views/layout/header.php';
?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fa-solid fa-chart-line text-primary me-2"></i> Panel de Administración</h2>
    </div>

    <div class="row g-4 mb-4">
        <!-- card estadisticas -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-primary text-white h-100">
                <div class="card-body text-center py-4">
                    <i class="fa-solid fa-users fa-3x mb-3 opacity-75"></i>
                    <h3 class="card-title h2 mb-0"><?= $totalUsuarios ?></h3>
                    <p class="card-text">Usuarios Registrados</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-success text-white h-100">
                <div class="card-body text-center py-4">
                    <i class="fa-solid fa-paw fa-3x mb-3 opacity-75"></i>
                    <h3 class="card-title h2 mb-0"><?= $totalMascotas ?></h3>
                    <p class="card-text">Mascotas Totales</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-info text-white h-100">
                <div class="card-body text-center py-4">
                    <i class="fa-solid fa-house-chimney-user fa-3x mb-3 opacity-75"></i>
                    <h3 class="card-title h2 mb-0"><?= $mascotasAdoptadas ?></h3>
                    <p class="card-text">Mascotas Adoptadas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 bg-warning text-dark h-100">
                <div class="card-body text-center py-4">
                    <i class="fa-solid fa-envelope-open-text fa-3x mb-3 opacity-75"></i>
                    <h3 class="card-title h2 mb-0"><?= $solicitudesPendientes ?></h3>
                    <p class="card-text">Solicitudes Pendientes</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Accesos Directos -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fa-solid fa-users-gear text-primary me-2"></i> Gestión de
                        Usuarios</h5>
                    <p class="text-muted">Administra los usuarios registrados, cambia sus roles (Administrador,
                        Rescatista, Adoptante) o desactiva cuentas si es necesario.</p>
                    <a href="index.php?action=admin_usuarios" class="btn btn-outline-primary">Ir a Usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fa-solid fa-cat text-success me-2"></i> Gestión de Mascotas
                    </h5>
                    <p class="text-muted">Visualiza el catálogo completo de mascotas de todos los rescatistas,
                        incluyendo aquellas que ya han sido adoptadas.</p>
                    <a href="index.php?action=admin_mascotas" class="btn btn-outline-success">Ir a Mascotas</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fa-solid fa-dog text-warning me-2"></i> Gestión de Razas
                    </h5>
                    <p class="text-muted">Añade razas nuevas a la base de datos para que los rescatistas las usen.</p>
                    <a href="index.php?action=admin_razas" class="btn btn-outline-warning">Ir a Razas</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>
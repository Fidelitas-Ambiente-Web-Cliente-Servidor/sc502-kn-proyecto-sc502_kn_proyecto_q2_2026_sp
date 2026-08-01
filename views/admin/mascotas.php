<?php include 'views/layout/header.php'; ?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fa-solid fa-cat text-success me-2"></i> Todas las Mascotas (Global)</h2>
        <div>
            <a href="index.php?action=mascota_crear" class="btn btn-verde me-2"><i class="fa-solid fa-plus me-1"></i> Añadir Mascota</a>
            <a href="index.php?action=admin_dashboard" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Volver al Dashboard</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Mascota</th>
                            <th>Especie/Raza</th>
                            <th>Rescatista</th>
                            <th>Estado</th>
                            <th>Publicación</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mascotas as $mascota): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-secondary">#<?= $mascota['id'] ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <img src="<?= htmlspecialchars($mascota['foto_path'] ?: 'https://via.placeholder.com/150') ?>" alt="Mascota" class="rounded-circle object-fit-cover" width="40" height="40">
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold"><?= htmlspecialchars($mascota['nombre']) ?></h6>
                                            <small class="text-muted"><?= htmlspecialchars($mascota['edad']) ?> meses</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div><?= htmlspecialchars($mascota['nombre_especie'] ?? 'N/A') ?></div>
                                    <small class="text-muted"><?= htmlspecialchars($mascota['nombre_raza'] ?? 'N/A') ?></small>
                                </td>
                                <td>
                                    <a href="mailto:<?= htmlspecialchars($mascota['rescatista_correo'] ?? '') ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($mascota['rescatista_correo'] ?? 'Sin correo') ?>
                                    </a>
                                </td>
                                <td>
                                    <?php
                                        $badgeClass = 'bg-success'; // Adoptado
                                        if ($mascota['estado'] == 'Urgente') $badgeClass = 'bg-warning text-dark';
                                        if ($mascota['estado'] == 'Disponible') $badgeClass = 'bg-primary';
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($mascota['estado']) ?></span>
                                </td>
                                <td><?= date('d/m/Y', strtotime($mascota['fecha_publicacion'])) ?></td>
                                <td class="text-end pe-4">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle border border-light-subtle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                            <li><a class="dropdown-item text-primary fw-semibold" href="index.php?action=mascota_editar&id=<?= $mascota['id'] ?>"><i class="fa-solid fa-pen-to-square me-2"></i>Editar</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger fw-semibold" href="index.php?action=mascota_eliminar&id=<?= $mascota['id'] ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar esta mascota? Esto no se puede deshacer.')"><i class="fa-solid fa-trash me-2"></i>Eliminar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($mascotas)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">No hay mascotas registradas en la plataforma.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>

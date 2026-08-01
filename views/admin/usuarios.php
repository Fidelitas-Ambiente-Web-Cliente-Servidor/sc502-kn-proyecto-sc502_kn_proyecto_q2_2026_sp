<?php include 'views/layout/header.php'; ?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fa-solid fa-users text-primary me-2"></i> Gestión de Usuarios</h2>
        <a href="index.php?action=admin_dashboard" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Volver al Dashboard</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Registro</th>
                            <th class="text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-secondary">#<?= $usuario['id'] ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <?= strtoupper(substr($usuario['nombre'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold"><?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']) ?></h6>
                                            <small class="text-muted"><?= htmlspecialchars($usuario['telefono'] ?? 'Sin teléfono') ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($usuario['correo']) ?></td>
                                <td>
                                    <!-- formulario para cambiar rol -->
                                    <form action="index.php?action=admin_cambiar_rol" method="POST" class="d-flex align-items-center" <?= ($usuario['id'] == $_SESSION['usuario_id']) ? 'style="pointer-events:none; opacity:0.6;"' : '' ?>>
                                        <input type="hidden" name="usuario_id" value="<?= $usuario['id'] ?>">
                                        <select name="nuevo_rol" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="1" <?= $usuario['rol_id'] == 1 ? 'selected' : '' ?>>Administrador</option>
                                            <option value="2" <?= $usuario['rol_id'] == 2 ? 'selected' : '' ?>>Rescatista</option>
                                            <option value="3" <?= $usuario['rol_id'] == 3 ? 'selected' : '' ?>>Adoptante</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <?php if(isset($usuario['estado']) && $usuario['estado'] == 'Inactivo'): ?>
                                        <span class="badge bg-danger">Inactivo</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Activo</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y', strtotime($usuario['fecha_registro'])) ?></td>
                                <td class="text-end pe-4">
                                    <?php if ($usuario['id'] != $_SESSION['usuario_id']): ?>
                                        <a href="index.php?action=admin_toggle_usuario&id=<?= $usuario['id'] ?>" class="btn btn-sm <?= (isset($usuario['estado']) && $usuario['estado'] == 'Inactivo') ? 'btn-success' : 'btn-outline-danger' ?>">
                                            <?php if(isset($usuario['estado']) && $usuario['estado'] == 'Inactivo'): ?>
                                                <i class="fa-solid fa-check me-1"></i> Activar
                                            <?php else: ?>
                                                <i class="fa-solid fa-ban me-1"></i> Desactivar
                                            <?php endif; ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">Tú (Admin)</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($usuarios)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">No hay usuarios registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>

CREATE DATABASE IF NOT EXISTS huellas_felices;
USE huellas_felices;

CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL
);
CREATE TABLE IF NOT EXISTS especies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_especie VARCHAR(50) NOT NULL
);
CREATE TABLE IF NOT EXISTS razas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    especie_id INT NOT NULL,
    nombre_raza VARCHAR(100) NOT NULL,
    FOREIGN KEY (especie_id) REFERENCES especies(id)
);
CREATE TABLE IF NOT EXISTS tamanos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL
);
CREATE TABLE IF NOT EXISTS niveles_energia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL
);
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rol_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (rol_id) REFERENCES roles(id)
);
CREATE TABLE IF NOT EXISTS mascotas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    especie_id INT NOT NULL,
    raza_id INT NOT NULL,
    tamano_id INT NOT NULL,
    energia_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    edad INT NOT NULL,
    historia TEXT,
    foto_path VARCHAR(255),
    estado ENUM('Disponible', 'Adoptado', 'Urgente') DEFAULT 'Disponible',
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (especie_id) REFERENCES especies(id),
    FOREIGN KEY (raza_id) REFERENCES razas(id),
    FOREIGN KEY (tamano_id) REFERENCES tamanos(id),
    FOREIGN KEY (energia_id) REFERENCES niveles_energia(id)
);
CREATE TABLE IF NOT EXISTS solicitudes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mascota_id INT NOT NULL,
    usuario_id INT NOT NULL, -- el adoptante
    mensaje TEXT,
    estado_solicitud ENUM('Pendiente', 'Aprobada', 'Rechazada') DEFAULT 'Pendiente',
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (mascota_id) REFERENCES mascotas(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);


--pruebas
INSERT INTO roles (nombre_rol) VALUES 
('Administrador'),
('Rescatista'),
('Adoptante');

INSERT INTO especies (nombre_especie) VALUES 
('Perro'),
('Gato');

INSERT INTO razas (especie_id, nombre_raza) VALUES 
(1, 'Mestizo (Zaguates)'),
(1, 'Labrador Retriever'),
(1, 'Golden Retriever'),
(1, 'Pug');

INSERT INTO razas (especie_id, nombre_raza) VALUES 
(2, 'Mestizo (Carey, Romano, etc)'),
(2, 'Siamés'),
(2, 'Persa');

INSERT INTO tamanos (descripcion) VALUES 
('Mini (menos de 5kg)'),
('Pequeño (5-10kg)'),
('Mediano (10-25kg)'),
('Grande (más de 25kg)');

INSERT INTO niveles_energia (descripcion) VALUES 
('Baja (tranquilo, dormilon)'),
('Media (juega un rato, luego descansa)'),
('Alta (necesita mucha actividad física)');

--usuario rescatista de prueba 
--contra: 123456 en hash estandar md5 o bcrypt, 
--hash de bcrypt para '123456' por defecto
--$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi es 'password', 
--esto es pa testar nada mas
INSERT INTO usuarios (rol_id, nombre, apellido, correo, contrasena, telefono) VALUES 
(2, 'Elena', 'Ruiz', 'elena@huellasfelices.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8888-8888');

-- mascotas de prueba
INSERT INTO mascotas (usuario_id, especie_id, raza_id, tamano_id, energia_id, nombre, edad, historia, foto_path, estado) VALUES 
(1, 1, 1, 3, 3, 'Max', 12, 'Un compañero leal que ama las caminatas largas y correr en el parque. Fue encontrado vagando en la calle.', '', 'Disponible'),
(1, 2, 5, 2, 1, 'Luna', 36, 'La reina del sofá. Tranquila, cariñosa y amante de las siestas largas al sol.', '', 'Disponible'),
(1, 1, 1, 1, 2, 'Pipo', 3, 'Pequeño en tamaño pero grande en personalidad. Juguetón y súper sociable.', '', 'Urgente');

--alter table para el sprint 6
ALTER TABLE solicitudes 
DROP FOREIGN KEY solicitudes_ibfk_2; 

ALTER TABLE solicitudes
DROP COLUMN usuario_id,
CHANGE COLUMN estado_solicitud estado ENUM('Pendiente', 'Aprobada', 'Rechazada') DEFAULT 'Pendiente',
CHANGE COLUMN fecha_envio created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN nombre_adoptante VARCHAR(100) NOT NULL AFTER mascota_id,
ADD COLUMN correo_adoptante VARCHAR(150) NOT NULL AFTER nombre_adoptante;


--sprint 9 fase 2 admin 
ALTER TABLE usuarios ADD COLUMN estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo';


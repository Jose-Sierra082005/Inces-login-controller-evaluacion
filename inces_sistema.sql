-- Crear base de datos
CREATE DATABASE IF NOT EXISTS inces_sistema;

-- Usar la base de datos creada
USE inces_sistema;

-- Tabla usuario (se debe crear primero porque otras tablas la referencian)
CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    tipo_usuario ENUM('Administrador', 'Auxiliar') NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL UNIQUE,
    activo BOOLEAN DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla participante
CREATE TABLE participante (
    id_participante INT AUTO_INCREMENT PRIMARY KEY,
    tipo_identificacion ENUM('Cédula', 'Pasaporte') NOT NULL,
    identificacion VARCHAR(20) NOT NULL UNIQUE,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    municipio VARCHAR(50) NOT NULL,
    parroquia VARCHAR(50) NOT NULL,
    comuna VARCHAR(50),
    direccion_completa TEXT,
    nivel_academico ENUM('Primaria', 'Secundaria', 'Técnico', 'Universitario', 'Postgrado') NOT NULL,
    discapacidad BOOLEAN NOT NULL DEFAULT 0,
    correo_electronico VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT 1,
    usuario_creador INT,
    FOREIGN KEY (usuario_creador) REFERENCES usuario(id_usuario) ON DELETE SET NULL,
    INDEX idx_usuario_creador (usuario_creador)
);

-- Tabla instructor
CREATE TABLE instructor (
    id_instructor INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(15) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    experiencia_anios INT DEFAULT 0,
    certificado BOOLEAN NOT NULL DEFAULT 0,
    direccion TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT 1
);

-- Tabla tipo_curso
CREATE TABLE tipo_curso (
    id_tipo_curso INT AUTO_INCREMENT PRIMARY KEY,
    nombre_tipo_curso VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT NOT NULL
);

-- Tabla curso
CREATE TABLE curso (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    nombre_curso VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    duracion INT NOT NULL,
    id_tipo_curso INT NOT NULL,
    nivel_dificultad ENUM('Básico', 'Intermedio', 'Avanzado') NOT NULL DEFAULT 'Básico',
    precio DECIMAL(10, 2) DEFAULT 0.00,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tipo_curso) REFERENCES tipo_curso(id_tipo_curso) ON DELETE CASCADE,
    INDEX idx_tipo_curso (id_tipo_curso)
);

-- Tabla curso_apertura
CREATE TABLE curso_apertura (
    id_curso_apertura INT AUTO_INCREMENT PRIMARY KEY,
    id_curso INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    cupos INT NOT NULL,
    estado ENUM('Abierto', 'Cerrado', 'En Progreso', 'Finalizado') DEFAULT 'Abierto',
    modalidad ENUM('Presencial', 'Virtual', 'Híbrido') DEFAULT 'Presencial',
    FOREIGN KEY (id_curso) REFERENCES curso(id_curso) ON DELETE CASCADE,
    INDEX idx_curso (id_curso)
);

-- Tabla participante_curso
CREATE TABLE participante_curso (
    id_participante_curso INT AUTO_INCREMENT PRIMARY KEY,
    id_participante INT NOT NULL,
    id_curso_apertura INT NOT NULL,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado_inscripcion ENUM('Inscrito', 'Retirado', 'Finalizado') DEFAULT 'Inscrito',
    calificacion DECIMAL(5, 2) CHECK (calificacion BETWEEN 0 AND 20),
    comentarios TEXT,
    FOREIGN KEY (id_participante) REFERENCES participante(id_participante) ON DELETE CASCADE,
    FOREIGN KEY (id_curso_apertura) REFERENCES curso_apertura(id_curso_apertura) ON DELETE CASCADE,
    INDEX idx_participante (id_participante),
    INDEX idx_curso_apertura (id_curso_apertura)
);

-- Tabla instructor_curso
CREATE TABLE instructor_curso (
    id_instructor_curso INT AUTO_INCREMENT PRIMARY KEY,
    id_instructor INT NOT NULL,
    id_curso_apertura INT NOT NULL,
    fecha_asignacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    rol ENUM('Principal', 'Asistente') DEFAULT 'Principal',
    FOREIGN KEY (id_instructor) REFERENCES instructor(id_instructor) ON DELETE CASCADE,
    FOREIGN KEY (id_curso_apertura) REFERENCES curso_apertura(id_curso_apertura) ON DELETE CASCADE,
    INDEX idx_instructor (id_instructor),
    INDEX idx_curso_apertura (id_curso_apertura)
);


-- Tablas --

-- Tabla de enlaces para el sistema de navegación
CREATE TABLE 
enlaces (
    pk_enlaces SERIAL PRIMARY KEY NOT NULL,
    nombre VARCHAR(55) NOT NULL,
    ruta VARCHAR(100) NOT NULL,
    hora TIME NOT NULL DEFAULT CURRENT_TIME,
    fecha DATE NOT NULL DEFAULT CURRENT_DATE,
    estado SMALLINT NOT NULL DEFAULT 1
);

-- Insertar enlaces 
INSERT INTO enlaces (nombre, ruta) VALUES 
('principal', 'app/views/modules/dashboard.php');

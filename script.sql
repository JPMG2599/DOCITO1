CREATE DATABASE Citas;
USE Citas;

CREATE TABLE Cliente (
	id_cliente INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(32) NOT NULL,
	correo VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    contrasena VARCHAR(60) NOT NULL
);

CREATE TABLE Doctor (
	id_doctor INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nombre VARCHAR(32) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    contrasena VARCHAR(60) NOT NULL,
    especialidad VARCHAR(50) NOT NULL
);

CREATE TABLE Asistente (
	id_cliente INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(32) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    contrasena VARCHAR(60) NOT NULL,
    id_doctor INT NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_doctor) REFERENCES Doctor (id_doctor)
);

CREATE TABLE Servicio (
	id_servicio INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    precio DECIMAL NOT NULL
);

CREATE TABLE Cita (
	id_cita INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    estado VARCHAR(50) NOT NULL,
    fecha DATETIME NOT NULL,
    id_cliente INT NOT NULL,
    id_doctor INT NOT NULL,
    id_servicio INT NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES Cliente (id_cliente),
    FOREIGN KEY (id_doctor) REFERENCES Doctor (id_doctor),
    FOREIGN KEY (id_servicio) REFERENCES Servicio (id_servicio)
);

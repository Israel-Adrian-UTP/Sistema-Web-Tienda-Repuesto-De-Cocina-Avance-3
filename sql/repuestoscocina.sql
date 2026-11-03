
--Creando Tabla roles
CREATE TABLE roles(
id_rol INT AUTO_INCREMENT PRIMARY KEY,
usuario VARCHAR(50) NOT NULL,
contrasena VARCHAR(50) NOT NULL,
rol VARCHAR(30) NOT NULL
);

--Creando Tabla inventario
CREATE TABLE inventario(
id_producto INT  AUTO_INCREMENT PRIMARY KEY,
nombre_producto VARCHAR(150) NOT NULL,
precio DECIMAL(10,2) NOT NULL,
existencia INT NOT NULL
);

--Insertando Datos En La Tabla roles
INSERT INTO roles(usuario,contrasena,rol) VALUES ('admin','admin','Administrador');
INSERT INTO roles(usuario,contrasena,rol) VALUES ('dev1','1111','Developer 1');
INSERT INTO roles(usuario,contrasena,rol) VALUES ('dev2','2222','Developer 2');
INSERT INTO roles(usuario,contrasena,rol) VALUES ('cons','3333','Consultor');

--Insertando Datos En La Tabla inventario
INSERT INTO inventario(nombre_producto,precio,existencia) VALUES ('Cocina De Mesa 2 Hornillas',49.90,15);
INSERT INTO inventario(nombre_producto,precio,existencia) VALUES ('Ron De Quemar',4.90,20);
INSERT INTO inventario(nombre_producto,precio,existencia) VALUES ('Manguera De Alta Presion 1.5 Metros + Regulador Alta Presion',39.90,10);
INSERT INTO inventario(nombre_producto,precio,existencia) VALUES ('Manguera De Baja Presion 1.5 Metros + Regulador Baja Presion',39.90,10);
INSERT INTO inventario(nombre_producto,precio,existencia) VALUES ('Quemador + Tapa De Bronce Cocina Indurama',119.90,12);
INSERT INTO inventario(nombre_producto,precio,existencia) VALUES ('Tapas De Cocina Mabe',79.90,12);
INSERT INTO inventario(nombre_producto,precio,existencia) VALUES ('Cuchilla Pica Hielo',29.90,6);
INSERT INTO inventario(nombre_producto,precio,existencia) VALUES ('Quemador Industrial',24.90,10);
INSERT INTO inventario(nombre_producto,precio,existencia) VALUES ('Regulador De Baja Presion',29.90,10);
INSERT INTO inventario(nombre_producto,precio,existencia) VALUES ('Regulador De Alta Presion',19.90,10);
INSERT INTO inventario(nombre_producto,precio,existencia) VALUES ('Manguera De Gas Natural 1.5 Metros',29.90,30);

--Ver Tablas
SELECT * FROM roles;
SELECT * FROM inventario;

--Eliminar Tablas
DROP TABLE roles;
DROP TABLE inventario;

# prueba_konecta
Prueba Konecta: proyecto que permite aún administrado, registra, editar, eliminar, listar, producto y visualizar ventas que se realicen en su tienda, en la cual se permite simular la compra de productos y restar al stock de dicho producto.

# base de datos, esta la opcion de copiar y pegar o la de importar bd_cafeteria.sql
```
CREATE DATABASE bd_cafeteria;

USE bd_cafeteria;

CREATE TABLE tbl_productos(
	id int AUTO_INCREMENT PRIMARY key,
    nombre varchar(255) UNIQUE NOT null,
    referencia varchar(255) not null,
    precio int not null,
    peso int not null,
    categoria int not null,
    stock int not null,
    estado SMALLINT DEFAULT '1',
    fecha_creacion datetime,
    fecha_actualizacion datetime
);

CREATE table tbl_categotia(
	id int AUTO_INCREMENT PRIMARY key,
    nombre varchar(255) UNIQUE NOT null,
 	fecha_creacion datetime,
    fecha_actualizacion datetime
);

CREATE TABLE tbl_ventas(
	id int AUTO_INCREMENT PRIMARY key,
	idProducto int not null,
    nombre varchar(255) not null,
    precio int not null,
    stock int not null,
    categoria int not null,
    estado SMALLINT DEFAULT '1',
    fecha_creacion datetime,
    fecha_actualizacion datetime
);

```

# consultas directas en base de datos

### Realizar una consulta que permita conocer cuál es el producto que más stock tiene.
SELECT id, nombre, MAX(stock) as stock  FROM `tbl_productos` WHERE estado = 1;

### Realizar una consulta que permita conocer cuál es el producto más vendido.
SELECT nombre, SUM(stock) as cantidad, SUM(precio) as precio FROM `tbl_ventas` GROUP BY nombre ORDER by cantidad DESC LIMIT 1;

# Pasos para la instalacion y prueba
### 1) installar Wampserver
### 2) copiar y pegar el proyecto en la carpeta www de Wampserver (nombre del proyecto o carpeta es "konectaCafe") --> ruta del archivo quedaria asi C:\wamp64\www\konectaCafe
### 3) nombrar al proyecto konectaCafe , por configuraciones de base_url en app del framework
### 4) cuando inicias http://localhost/konectaCafe no se visualizaran producto hasta que no ingreses al admin y registres productos
### 5) las credenciales del admin son usuario: admin y contraseña: admin123 por defecto
### 6) al inicar al Dash primero debes registrar una categoria, para poder registrar un producto.
### 7) cuando registres el producto automaticamente puedes volver a  http://localhost/konectaCafe visualizar todos los producto en la caferia para la compra, o seleccionar por categoria

### Cualquier inquietud durante el test y prueba mi numero 323 2346794

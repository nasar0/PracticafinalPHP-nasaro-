# 🎮📒 Agenda de Juegos y Amigos - Proyecto Final PHP

Este es el proyecto final de **Desarrollo Web en Entorno Servidor**, desarrollado en PHP y MySQL. La aplicación permite a los usuarios gestionar su **agenda personal** con los datos de sus **amigos**, **juegos** y **préstamos** de juegos.

## 🚀 Funcionalidades principales

### ✅ Gestión de usuarios
- Autenticación con nombre de usuario y contraseña.
- Panel de administración con gestión completa de usuarios.
- Inserción, búsqueda, edición y listado de usuarios.
- Contraseñas enmascaradas en el panel de administrador.

### 👥 Gestión de amigos
- Añadir nuevos amigos (nombre, apellidos, fecha de nacimiento).
- Buscar amigos por nombre o apellidos.
- Modificar los datos de amigos existentes.
- Listado de amigos del usuario logueado, con fecha en formato español.
- Ordenar por nombre o fecha de nacimiento.

### 🎮 Gestión de juegos
- Añadir nuevos juegos (nombre, plataforma, año, imagen).
- Buscar juegos por título o plataforma.
- Editar los datos de los juegos.
- Ver listado de todos los juegos con imagen incluida.

### 🔁 Gestión de préstamos
- Insertar nuevos préstamos mediante formularios con listas desplegables (amigo y juego).
- Registrar automáticamente como **no devuelto**.
- Buscar préstamos por nombre del amigo o título del juego.
- Listado de todos los préstamos con:
  - Nombre del amigo.
  - Foto del juego prestado.
  - Fecha del préstamo (en formato español).
  - Estado del préstamo (devuelto o no).
  - Botón para marcar como devuelto (inactivo si ya lo está).

### 🛠️ Área del Administrador (`admin-admin`)
- Acceso a todos los menús: amigos, juegos y usuarios.
- Ver quién creó cada contacto.
- Capacidad para insertar, modificar y buscar en todos los módulos.

---

## 📂 Estructura del proyecto
 ```bash
/PROYECTO/
│
├── CONTROLADOR/
│ ├── login.php
│ ├── listaamigos.php
│ ├── listajuegos.php
│ ├── listaprestamos.php
│ └── otros controladores...
│
├── MODELO/
│ ├── class-amigos.php
│ ├── class-juegos.php
│ ├── class-prestamos.php
│ └── class-usuarios.php
│
├── VISTA/
│ ├── index.php
│ ├── login.php
│ ├── amigos.php
│ ├── juegos.php
│ ├── prestamos.php
│ ├── insertar.php
│ └── otros formularios y vistas...
│
└── README.md
 ```
---

## 🧑‍💻 Tecnologías utilizadas

- **PHP** (Programación del lado del servidor)
- **MySQL** (Gestión de base de datos relacional)
- **HTML/CSS** (Estructura y estilo de la interfaz web)
- **Sesiones PHP** (Gestión de usuarios)
- **MVC estructural** (Separación de lógica, presentación y datos)

---

## 🔒 Requisitos para ejecutar

- Servidor web Apache (recomendado: XAMPP, MAMP o WAMP)
- PHP 7.x o superior
- MySQL 5.7 o superior
- Navegador web moderno

---

## ⚙️ Instalación

1. Clona este repositorio en la carpeta `htdocs` (si usas XAMPP):

   ```bash
   git clone https://github.com/tuusuario/agenda-amigos-juegos.git
Importa el archivo .sql con la estructura y datos de ejemplo de la base de datos (si está incluido).

Configura los parámetros de conexión a la base de datos en los archivos del modelo (class-*.php).

Inicia el servidor Apache y MySQL desde tu panel de control (ej. XAMPP).

Accede desde tu navegador:

 ```arduino
http://localhost/agenda-amigos-juegos
 ```
## Inicia sesión con las credenciales por defecto:

Usuario: admin

Contraseña: admin

## 📝 Notas finales
La aplicación usa sesiones para mantener el estado del usuario logueado.

El área de administración permite una gestión más amplia de los datos, útil para docentes o supervisores.

Este proyecto puede evolucionar para incluir validaciones con JavaScript, seguridad avanzada o migrarse a un framework como Laravel.

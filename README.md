# Estética V-B

**Proyecto académico para la materia:** Taller de Programación I  
**Estudiantes:** González Billordo Abel - Vera Pablo Gabriel  
**Profesor:** Alonso Manuel José  
**Fecha de entrega:** 28 de Abril del 2025

---

## Índice

1. [Introducción](#introducción)
2. [Objetivos](#objetivos)
3. [Tecnologías Utilizadas](#tecnologías-utilizadas)
4. [Estructura del Proyecto](#estructura-del-proyecto)
5. [Instalación y Puesta en Marcha](#instalación-y-puesta-en-marcha)
6. [Funcionalidades Principales](#funcionalidades-principales)
7. [Páginas del Sitio](#páginas-del-sitio)
8. [Capturas de Pantalla](#capturas-de-pantalla)
9. [Conclusión y Mejoras Futuras](#conclusión-y-mejoras-futuras)

---

## 1. Introducción

Este proyecto consiste en el desarrollo de un sitio web para **Estética V-B**, un emprendimiento especializado en tratamientos capilares, cortes, peinados, coloraciones, laminados y perfilados, además de la venta de productos de cuidado capilar.

El objetivo es brindar una plataforma accesible, moderna y profesional para que las clientas conozcan los servicios y productos disponibles, puedan realizar compras online y comunicarse fácilmente con la empresa.

---

## 2. Objetivos

- Desarrollar un sitio web responsive y moderno utilizando Bootstrap 5 y CodeIgniter 4.
- Promocionar los servicios y productos de la estética.
- Facilitar la comunicación y el contacto con las clientas.
- Permitir la gestión de productos, ventas y usuarios desde un panel administrativo.
- Mejorar la imagen profesional y la presencia digital de la empresa.

---

## 3. Tecnologías Utilizadas

- **Frontend:** HTML5, CSS3, Bootstrap 5, FontAwesome
- **Backend:** PHP 8, CodeIgniter 4
- **Base de datos:** MySQL/MariaDB
- **Servidor local:** XAMPP
- **Editor:** Visual Studio Code

---

## 4. Estructura del Proyecto

```
Proyecto_Estetica/
│
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
│   │   ├── principal.php
│   │   ├── quienes_somos.php
│   │   ├── comercializacion.php
│   │   ├── terminos_uso.php
│   │   ├── informacion_contacto.php
│   │   └── Partials/
│   │       ├── nav_home.php
│   │       └── footer.php
│   └── Config/
│
├── public/
│   └── assets/
│       ├── css/
│       │   ├── estilos-principal.css
│       │   ├── estilos-quienesSomos.css
│       │   ├── estilos-comercializacion.css
│       │   ├── estilos-terminosUso.css
│       │   ├── estilos-navbar.css
│       │   ├── estilos-informacionContacto.css
│       │   └── estilo-footer.css
│       └── img/
│
├── writable/
├── index.php
└── README.md
```

---

## 5. Instalación y Puesta en Marcha

1. **Clonar el repositorio o copiar los archivos al servidor local.**
2. **Configurar la base de datos:**
   - Crear una base de datos en MySQL/MariaDB (por ejemplo, `bd_estetica`).
   - Importar el archivo de estructura y datos si se provee (`database.sql`).
   - Configurar los datos de conexión en `app/Config/Database.php`.
3. **Instalar dependencias (si aplica):**
   - Si usas Composer: `composer install`
4. **Iniciar el servidor local:**
   - Iniciar Apache y MySQL desde XAMPP.
   - Acceder al sitio desde [http://localhost/Proyecto_Estetica/public](http://localhost/Proyecto_Estetica/public)
5. **Usuarios de prueba:**
   - Se recomienda crear usuarios desde el formulario de registro o cargar datos de ejemplo en la base.

---

## 6. Funcionalidades Principales

- **Catálogo de productos:** Visualización, búsqueda y filtrado de productos.
- **Carrito de compras:** Agregar, quitar y modificar cantidades de productos.
- **Proceso de compra:** Checkout, validación de stock y generación de historial de compras.
- **Gestión de usuarios:** Registro, login, edición de perfil y roles (cliente/admin).
- **Panel administrativo:** Gestión de productos, categorías, ventas y usuarios.
- **Sistema de favoritos:** Guardar productos preferidos para compras futuras.
- **Soporte y contacto:** Formulario de contacto y sección de ayuda.
- **Responsive design:** Adaptado a dispositivos móviles y escritorio.

---

## 7. Páginas del Sitio

- **Principal:** Presentación general de la estética.
- **Quiénes Somos:** Historia, misión, visión y equipo profesional.
- **Comercialización:** Información sobre formas de pago, envíos y condiciones de compra.
- **Catálogo:** Listado de productos con opción de búsqueda y filtrado.
- **Carrito:** Visualización y gestión de productos seleccionados para comprar.
- **Historial de Compras:** Visualización de compras realizadas por el usuario.
- **Panel Admin:** Gestión de productos, ventas, usuarios y categorías (solo administradores).
- **Información de Contacto:** Datos de contacto y formulario para consultas.
- **Términos y Usos:** Reglas y políticas de uso de los servicios y productos.

---

## 8. Conclusión y Mejoras Futuras

El desarrollo de este sitio web permite a **Estética V-B** mejorar su presencia digital, facilitar el acceso a información y productos para sus clientas y posicionarse como una empresa moderna y profesional.

### Mejoras futuras propuestas:

- Incorporar reservas de turnos online.
- Implementar notificaciones por email.
- Mejorar la gestión de stock y reportes de ventas.
- Agregar pasarela de pagos online.
- Integrar un dashboard de estadísticas para el administrador.

---

**¡Gracias por revisar nuestro proyecto!**

Para cualquier consulta técnica, contactar a los desarrolladores o al profesor responsable.

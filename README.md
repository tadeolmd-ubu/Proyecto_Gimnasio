# Documentación del Proyecto: Sistema de Gestión de Gimnasio

Este documento sirve como guía de referencia y documentación técnica para el sistema de gestión de un gimnasio. Describe la estructura del proyecto, la organización de sus módulos, los componentes de *backend* y el esquema detallado de la base de datos.

---

## 📂 Estructura del Proyecto (`Proyecto_Gimnasio`)

La estructura de directorios sigue una arquitectura estándar de desarrollo web, separando claramente los activos (estilos, imágenes), la lógica de negocio (PHP) y los scripts de persistencia de datos (SQL).

```
Proyecto_Gimnasio/
├── css/                # Estilos de la interfaz de usuario.
│   └── styles.css      # Hoja de estilos principal para el front-end.
├── database/           # Scripts de la base de datos (SQL).
│   ├── bd_gimnasio_mysql.sql       # Script principal de creación y estructura de la base de datos.
│   ├── limpiar_membresias_duplicadas.sql # Script para la limpieza de registros redundantes.
│   ├── migracion_inscripcion.sql  # Script de migración o actualización de datos de inscripción.
│   └── procedimientos_almacenados.sql # Contiene las funciones y procedimientos de negocio en el servidor.
├── img/                # Carpeta de recursos visuales (imágenes).
│   ├── entrenador_1.jpeg
│   ├── entrenadora.jpeg
│   ├── grillo.png
│   ├── gym_area_weights_1776643231254.png
│   ├── gym_hero_bg_1776643148838.png
│   ├── gym_hero_bg_blue_1776643518741.png
│   ├── gym_trainer_f_1776643216280.png
│   ├── gym_trainer_m_1776643162211.png
│   ├── hero_bg.png
│   ├── icono_steelyco.png
│   ├── vinivinivini.png
│   ├── zona_de_mancuernas.png
│   ├── zona_pecho.jpg
│   ├── zona_pecho_2.jpg
│   └── zona_pierna.jpg
├── index.php           # Página principal o *homepage* del sistema.
├── js/                 # Archivos de JavaScript del cliente.
│   └── main.js         # Lógica interactiva del front-end.
└── php/                # Lógica de negocio y *backend* del sistema.
    ├── admin_panel.php          # Gestión administrativa del sistema.
    ├── conexion.php             # Script de conexión a la base de datos.
    ├── dashboard.php            # Panel principal de estadísticas o resumen.
    ├── inscripcion.php          # Gestión de procesos de inscripción.
    ├── login.php                # Formulario y lógica de autenticación de usuarios.
    ├── logout.php               # Script para cerrar la sesión de usuario.
    ├── mis_membresias.php       # Visualización y gestión de membresías activas.
    └── register.php             # Proceso de registro de nuevos usuarios.
```

---

## 🧩 Módulos Funcionales

Esta tabla organiza el proyecto por sus módulos principales, facilitando la navegación y comprensión de la responsabilidad de cada sección.

| Módulo | Descripción | Contenido |
| :--- | :--- | :--- |
| **[Proyecto_Gimnasio]** | **Raíz del Sistema.** Punto de entrada general del proyecto. | `index.php` |
| **[css]** | **Estilos Globales.** Contiene todas las reglas de estilo CSS para el diseño visual. | `styles.css` |
| **[database]** | **Base de Datos (SQL).** Scripting para la inicialización, migración y manipulación de la estructura de datos. | 4 scripts |
| **[js]** | **Lógica Cliente (Javascript).** Implementa la interactividad y el manejo del lado del cliente. | 1 archivo |
| **[php]** | **Lógica de Negocio (Backend).** Contiene la mayor parte de la funcionalidad del sistema, manejando peticiones, sesiones y bases de datos. | 8 archivos |

---

## 💾 Esquema de la Base de Datos (Database Schema)

La base de datos está diseñada para gestionar la relación compleja entre usuarios, membresías, horarios de entrenamiento y servicios ofrecidos.

| Tipo | Nombre de la Tabla | Descripción del Contenido | Columnas |
| :--- | :--- | :--- | :--- |
| **Tabla** | `Rol` | Define los diferentes niveles de acceso y permisos dentro del sistema (ej. Administrador, Cliente). | 2 |
| **Tabla** | `Usuario` | Almacena la información de autenticación y perfil de los usuarios. | 5 |
| **Tabla** | `Cliente` | Perfil específico del cliente inscrito en el gimnasio. | 7 |
| **Tabla** | `Tipo_Membresia` | Catálogo de los diferentes tipos de membresía disponibles (ej. Mensual, Anual). | 3 |
| **Tabla** | `Membresia` | Registra las membresías asignadas a los clientes, incluyendo fechas de inicio y fin. | 7 |
| **Tabla** | `Turno` | Define los diferentes turnos operacionales del gimnasio. | 4 |
| **Tabla** | `Entrenador` | Base de datos de los profesionales y entrenadores del gimnasio. | 7 |
| **Tabla** | `Especialidad` | Catálogo de especialidades que pueden tener los entrenadores. | 2 |
| **Tabla** | `Especialidad_Entrenador` | Tabla relacional (many-to-many) que vincula a un entrenador con sus especialidades. | 3 |
| **Tabla** | `Dia` | Define los días de la semana o días operativos. | 3 |
| **Tabla** | `Horario` | Estructura los horarios y horarios generales de operación. | 5 |
| **Tabla** | `Horario_Entrenador` | Vincula a los entrenadores con los horarios específicos en los que están disponibles. | 3 |
| **Tabla** | `Producto` | Catálogo de productos o servicios adicionales que se pueden vender. | 4 |
| **Tabla** | `Asistencia` | Registra el historial de acceso y participación de los clientes en el gimnasio. | 5 |
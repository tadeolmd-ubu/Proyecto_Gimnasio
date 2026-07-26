# Proyecto_Gimnasio

## Overview

### Technologies Used

| Technology |
|------------|
| CSS |
| SQL |
| PHP |
| JavaScript |

### Technology Implementation Files

| Technology | File |
|------------|------|
| CSS | styles.css |
| SQL | bd_gimnasio_mysql.sql |
| PHP | admin_panel.php, conexion.php, dashboard.php, inscripcion.php, login.php, logout.php, mis_membresias.php, register.php |
| JavaScript | main.js |

## Project Structure

The directory structure contains resources, documentation, and core logic for the gym management system.

```
repository/
├── README.md
├── css/
│   └── styles.css
├── database/
│   ├── bd_gimnasio_mysql.sql — Script principal para la creación de la base de datos MySQL.
│   ├── limpiar_membresias_duplicadas.sql — Limpia registros duplicados de membresías.
│   ├── migracion_inscripcion.sql — Gestiona las migraciones y datos de inscripción.
│   └── procedimientos_almacenados.sql — Contiene procedimientos y funciones de bases de datos.
├── docs/
│   ├── Proyecto_Gimnasio.md — Documentación general del proyecto de gimnasio.
│   ├── css.md — Detalles de la implementación de estilos CSS.
│   ├── database.md — Documentación sobre la estructura y gestión de la base de datos.
│   ├── js.md — Descripción y uso de la lógica de JavaScript.
│   ├── php.md — Guía de la lógica y módulos PHP.
│   └── repository.md — Documentación de la estructura del repositorio.
├── img/
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
├── index.php
├── js/
│   └── main.js
└── php/
    ├── admin_panel.php
    ├── conexion.php
    ├── dashboard.php
    ├── inscripcion.php
    ├── login.php
    ├── logout.php
    ├── mis_membresias.php
    └── register.php
```

## Modules

### CSS
This module manages the styling and visual presentation of the entire user interface, ensuring a cohesive look across all pages.
| Module | Files |
|--------|------|
| [css](docs/css.md) | 1 |

### database
This section handles all database documentation, including schema definitions, migration scripts, and stored procedures.
| Module | Files |
|--------|------|
| [database](docs/database.md) | 4 |

### JS
This module encapsulates the client-side interactivity and dynamic behaviors of the application.
| Module | Files |
|--------|------|
| [js](docs/js.md) | 1 |

### PHP
This module contains the backend business logic, managing sessions, database interactions, and application flow.
| Module | Files |
|--------|------|
| [php](docs/php.md) | 8 |

## Database Schema

| Type | Name | Details |
|------|------|---------|
| Table | Rol | 2 columns |
| Table | Usuario | 5 columns |
| Table | Cliente | 7 columns |
| Table | Tipo_Membresia | 3 columns |
| Table | Membresia | 7 columns |
| Table | Turno | 4 columns |
| Table | Entrenador | 7 columns |
| Table | Especialidad | 2 columns |
| Table | Especialidad_Entrenador | 3 columns |
| Table | Dia | 3 columns |
| Table | Horario | 5 columns |
| Table | Horario_Entrenador | 3 columns |
| Table | Producto | 4 columns |
| Table | Asistencia | 5 columns |
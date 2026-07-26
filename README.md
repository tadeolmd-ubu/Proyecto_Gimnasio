# Proyecto_Gimnasio

## Overview

| Technology |
| :--- |
| CSS |
| SQL |
| PHP |
| JavaScript |

| Technology | File |
| :--- | :--- |

## Project Structure

```
repository/
├── README.md
├── css/styles.css
├── database/bd_gimnasio_mysql.sql
├── database/limpiar_membresias_duplicadas.sql
├── database/migracion_inscripcion.sql
├── database/procedimientos_almacenados.sql
├── docs/Proyecto_Gimnasio.md
├── docs/css.md
├── docs/database.md
├── docs/js.md
├── docs/php.md
├── docs/repository.md
├── img/entrenador_1.jpeg
├── img/entrenadora.jpeg
├── img/grillo.png
├── img/gym_area_weights_1776643231254.png
├── img/gym_hero_bg_1776643148838.png
├── img/gym_hero_bg_blue_1776643518741.png
├── img/gym_trainer_f_1776643216280.png
├── img/gym_trainer_m_1776643162211.png
├── img/hero_bg.png
├── img/icono_steelyco.png
├── img/vinivinivini.png
├── img/zona_de_mancuernas.png
├── img/zona_pecho.jpg
├── img/zona_pecho_2.jpg
├── img/zona_pierna.jpg
├── index.php
├── js/main.js
└── php/admin_panel.php
└── php/conexion.php
└── php/dashboard.php
└── php/inscripcion.php
└── php/login.php
└── php/logout.php
└── php/mis_membresias.php
└── php/register.php
```

## Modules

### CSS
The CSS module manages all the styling and visual presentation of the gym website, ensuring a consistent and responsive design across all pages.

| Link | File Count |
| :--- | :--- |
| [docs/css.md](docs/css.md) | 1 |

### Database
This module contains all the necessary SQL scripts for setting up, migrating, and maintaining the database structure and data integrity.

| Link | File Count |
| :--- | :--- |
| [docs/database.md](docs/database.md) | 4 |

### JS
The JavaScript module handles client-side interactivity and dynamic behavior for the user interface.

| Link | File Count |
| :--- | :--- |
| [docs/js.md](docs/js.md) | 1 |

### PHP
The PHP module encapsulates the core backend logic, managing user authentication, membership processing, and data interactions.

| Link | File Count |
| :--- | :--- |
| [docs/php.md](docs/php.md) | 8 |

## Database Schema

| Type | Name | Details |
| :--- | :--- | :--- |
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
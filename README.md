# Proyecto_Gimnasio


## Overview

### Tecnologías Utilizadas

| Tecnología |
| :--- |
| CSS |
| SQL |
| PHP |
| JavaScript |

### Tecnologías y Archivos

| Tecnología | Archivo |
| :--- | :--- |
| CSS | (N/A) |
| SQL | (N/A) |
| PHP | (N/A) |
| JavaScript | (N/A) |

## Project Structure

```
Proyecto_Gimnasio/
├── README.md
├── css
│   └── styles.css
├── database
│   ├── bd_gimnasio_mysql.sql
│   ├── limpiar_membresias_duplicadas.sql
│   ├── migracion_inscripcion.sql
│   └── procedimientos_almacenados.sql
├── docs
│   ├── css.md
│   ├── database.md
│   ├── js.md
│   └── php.md
├── img
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
├── js
│   └── main.js
└── php
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

| Module | Files |
| :--- | :--- |
| [css](docs/css.md) | 1 |
| *Contiene la documentación sobre los estilos y la hoja de estilo principal del proyecto.* | |
| [database](docs/database.md) | 4 |
| *Detalla la estructura y los scripts necesarios para la gestión de la base de datos MySQL.* | |
| [js](docs/js.md) | 1 |
| *Documenta el comportamiento y la lógica de interacción del lado del cliente con JavaScript.* | |
| [php](docs/php.md) | 8 |
| *Describe los archivos backend encargados de la lógica de negocio y la conexión con la base de datos.* | |

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
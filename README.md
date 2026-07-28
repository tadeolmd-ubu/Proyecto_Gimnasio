# Proyecto_Gimnasio


### Overview

| Technology | File |
|------------|------|

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
│   ├── gym_hero_bg_1776643518741.png
│   ├── gym_hero_bg_blue_1776643231484.png
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
    └── register.php```

## Modules

| Module | Files | Purpose---
Document content---|
| [css](docs/css.md) | 1 | CSS module documentation |
| [database](docs/database.md) | 4 | Database logic and queries---|
| [js](docs/js.md) | 1 | JavaScript module implementation---|
| [php](docs/php.md) | 8 | PHP backend functions and control---|

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

## Get Started

## Exports

| Export | Kind | File |
|--------|------|------|
| Database Dump | Database | bd_gimnasio_mysql.sql |
| Clean Members | SQL Script | limpiar_membresias_duplicadas.sql |
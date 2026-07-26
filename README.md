# Proyecto_Gimnasio

## Overview

### Technologies Used

| Technology |
| :--- |
| CSS |
| SQL |
| PHP |
| JavaScript |

### Technology Mapping

| Technology | File |
| :--- | :--- |
| CSS | styles.css |
| SQL | bd_gimnasio_mysql.sql, limpiar_membresias_duplicadas.sql, migracion_inscripcion.sql, procedimientos_almacenados.sql |
| PHP | admin_panel.php, conexion.php, dashboard.php, inscripcion.php, login.php, logout.php, mis_membresias.php, register.php |
| JavaScript | main.js |

## Project Structure

The project is organized into distinct directories for assets, documentation, and core application logic.

```
repository/
├── README.md
├── css/
│   └── styles.css
├── database/
│   ├── bd_gimnasio_mysql.sql
│   ├── limpiar_membresias_duplicadas.sql
│   ├── migracion_inscripcion.sql
│   └── procedimientos_almacenados.sql
├── docs/
│   ├── Proyecto_Gimnasio.md
│   ├── css.md
│   ├── database.md
│   ├── js.md
│   ├── php.md
│   └── repository.md
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

### File Structure Detail

| File | Description |
| :--- | :--- |
| README.md | Provides general project overview and setup instructions for developers. |
| css/styles.css | Defines the visual appearance and layout for the entire application interface. |
| database/bd_gimnasio_mysql.sql | Contains the initial SQL script to create the core database schema. |
| database/limpiar_membresias_duplicadas.sql | Executes SQL commands necessary to clean and de-duplicate membership records. |
| database/migracion_inscripcion.sql | Handles schema changes and data updates required for membership enrollment. |
| database/procedimientos_almacenados.sql | Contains reusable SQL logic encapsulated in stored procedures for database operations. |
| docs/Proyecto_Gimnasio.md | Main documentation file detailing the overall project structure and goals. |
| docs/css.md | Documentation specifically for the CSS styling module and related assets. |
| docs/database.md | Comprehensive documentation regarding the database design and SQL scripts. |
| docs/js.md | Documentation detailing the client-side JavaScript functionality and logic. |
| docs/php.md | Documentation describing the server-side PHP architecture and file responsibilities. |
| docs/repository.md | Guides users on navigating and utilizing the project's directory structure. |
| img/entrenador_1.jpeg | Image asset representing a gym trainer model (male). |
| img/entrenadora.jpeg | Image asset representing a gym trainer model (female). |
| img/grillo.png | Small graphic image asset used for UI decorative purposes. |
| img/gym_area_weights_1776643231254.png | Background image illustrating the gym weight area. |
| img/gym_hero_bg_1776643148838.png | Primary background image for the hero section of the website. |
| img/gym_hero_bg_blue_1776643518741.png | Alternative blue background image for the main hero section. |
| img/gym_trainer_f_1776643216280.png | Image asset for a female trainer model in the gym environment. |
| img/gym_trainer_m_1776643162211.png | Image asset for a male trainer model in the gym environment. |
| img/hero_bg.png | General background image asset suitable for the main page hero section. |
| img/icono_steelyco.png | Small icon asset used to represent a specific service or feature. |
| img/vinivinivini.png | Small decorative icon or graphic element. |
| img/zona_de_mancuernas.png | Promotional image marking the free weights area in the gym. |
| img/zona_pecho.jpg | Promotional image highlighting the chest workout area. |
| img/zona_pecho_2.jpg | Secondary promotional image for the chest workout zone. |
| img/zona_pierna.jpg | Promotional image indicating the dedicated leg workout area. |
| index.php | The primary entry point and main page controller for the web application. |
| js/main.js | Contains the core client-side JavaScript logic handling user interactions and frontend behavior. |
| php/admin_panel.php | Manages the administrative dashboard and control panel functionality for staff. |
| php/conexion.php | Handles the connection establishment and configuration for the database. |
| php/dashboard.php | Displays the main overview and key metrics for logged-in users. |
| php/inscripcion.php | Processes the front-end form and backend logic for new student enrollment. |
| php/login.php | Handles user authentication, processing login credentials and session start. |
| php/logout.php | Securely terminates the current user session and logs the user out. |
| php/mis_membresias.php | Displays the current and past membership details for the user account. |
| php/register.php | Handles the initial user account creation and registration process. |

## Modules

### Module: CSS
This module is responsible for styling the entire application, controlling layout, and ensuring cross-browser compatibility.

| Files | Count |
| :--- | :--- |
| [css/styles.css](css/styles.css) | 1 |

### Module: database
This module manages all database schema definitions, data migrations, and complex stored procedures.

| Files | Count |
| :--- | :--- |
| [database/bd_gimnasio_mysql.sql](database/bd_gimnasio_mysql.sql) | 1 |
| [database/limpiar_membresias_duplicadas.sql](database/limpiar_membresias_duplicadas.sql) | 1 |
| [database/migracion_inscripcion.sql](database/migracion_inscripcion.sql) | 1 |
| [database/procedimientos_almacenados.sql](database/procedimientos_almacenados.sql) | 1 |

### Module: js
This module contains the client-side scripting responsible for dynamic UI updates and interactive frontend logic.

| Files | Count |
| :--- | :--- |
| [js/main.js](js/main.js) | 1 |

### Module: php
This module encompasses the backend logic, handling user sessions, database interactions, and page rendering.

| Files | Count |
| :--- | :--- |
| [php/admin_panel.php](php/admin_panel.php) | 1 |
| [php/conexion.php](php/conexion.php) | 1 |
| [php/dashboard.php](php/dashboard.php) | 1 |
| [php/inscripcion.php](php/inscripcion.php) | 1 |
| [php/login.php](php/login.php) | 1 |
| [php/logout.php](php/logout.php) | 1 |
| [php/mis_membresias.php](php/mis_membresias.php) | 1 |
| [php/register.php](php/register.php) | 1 |

## Database Schema Overview

*   **`usuarios`**: Stores user account information (e.g., user ID, name, email, password hash).
*   **`membresias`**: Tracks membership details (e.g., membership ID, user ID, start date, end date, type).
*   **`servicios`**: Lists available services or packages (e.g., service ID, name, price).
*   **`detalles_membresia`**: Links memberships to services purchased (e.g., membership ID, service ID, quantity).
*   **`personal`**: Stores details about staff members working at the gym/facility.
# Module: php

This module represents the core backend logic and frontend structure for the application, managing user interactions, data persistence, and administrative functionality.

## File Structure

| File | Purpose |
| :--- | :--- |
| `admin_panel.php` | PHP module — Provides the main control interface for administrative tasks and content management. |
| `conexion.php` | PHP module — Handles the establishment and management of the database connection credentials. |
| `dashboard.php` | PHP module — Displays the primary landing page data, summarizing user information and memberships. |
| `inscripcion.php` | PHP module — Manages the process of new registrations and detailed enrollment records for members. |
| `login.php` | PHP module — Handles the authentication process, validating user credentials for system access. |
| `logout.php` | Pendiente de implementar — Archivo sin implementar — pendiente de definir responsabilidad |
| `mis_membresias.php` | PHP module — Displays the details regarding a specific user's active and historical memberships. |
| `register.php` | PHP module — Processes the initial user registration form submission and validation. |

## Functions

| Name | Kind | Async | File |
| :--- | :--- | :--- | :--- |
| ejecutarProcedimiento | undefined | | `admin_panel.php` |

## Exports

| Name | Kind | File |
| :--- | :--- | :--- |
| **`admin_panel.php`** | | |
| mensaje | variable | `admin_panel.php` |
| mensaje_tipo | variable | `admin_panel.php` |
| is_ajax | variable | `admin_panel.php` |
| ejecutarProcedimiento | function | `admin_panel.php` |
| stmt | variable | `admin_panel.php` |
| action | variable | `admin_panel.php` |
| resultado | variable | `admin_panel.php` |
| msg_limpio | variable | `admin_panel.php` |
| clientes | variable | `admin_panel.php` |
| entrenadores | variable | `admin_panel.php` |
| turnos | variable | `admin_panel.php` |
| **`conexion.php`** | | |
| serverName | variable | `conexion.php` |
| database | variable | `conexion.php` |
| username | variable | `conexion.php` |
| password | variable | `conexion.php` |
| conn | variable | `conexion.php` |
| **`dashboard.php`** | | |
| planes | variable | `dashboard.php` |
| stmt | variable | `dashboard.php` |
| entrenadores | variable | `dashboard.php` |
| cliente_nombre | variable | `dashboard.php` |
| cli | variable | `dashboard.php` |
| **`inscripcion.php`** | | |
| stmt | variable | `inscripcion.php` |
| **`login.php`** | | |
| usuario | variable | `login.php` |
| password | variable | `login.php` |
| stmtCliente | variable | `login.php` |
| undefined | variable | `login.php` |
| **`mis_membresias.php`** | | |
| stmt | variable | `mis_membresias.php` |
| membresias | variable | `mis_membresias.php` |
| cliente_nombre | variable | `mis_membresias.php` |
| tiene_membresia_activa | variable | `mis_membresias.php` |
| cli | variable | `mis_membresias.php` |
| **`register.php`** | | |
| usuario | variable | `register.php` |
| *(All other variables listed in the original source)* | | |
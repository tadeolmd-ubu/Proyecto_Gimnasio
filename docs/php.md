# Module: php

This module contains the core business logic and front-end structure for the entire application, managing user interactions, database operations, and page rendering.

## File Structure

| File | Purpose | Description |
| :--- | :--- | :--- |
| `admin_panel.php` | Contains administrative panel functionality. | Handles management of clients, trainers, and appointment schedules for administrators. |
| `conexion.php` | Manages database connection details. | Establishes and maintains the secure connection parameters to the main database system. |
| `dashboard.php` | Client's main portal view. | Displays key metrics and summaries for the client's personal information and membership details. |
| `inscripcion.php` | Handles new membership enrollment. | Manages the process of subscribing new users, associating them with plans and trainers. |
| `login.php` | Authentication mechanism. | Processes user credentials to authenticate users and manage session state. |
| `logout.php` | Authentication mechanism. | Archivo sin implementar — pendiente de definir responsabilidad |
| `mis_membresias.php` | Displays active memberships. | Shows the currently active memberships and associated details for the logged-in user. |
| `register.php` | Handles new user registration. | Processes the initial form data and creates new user accounts in the system. |

## Functions

| Name | Kind | Async | File |
| :--- | :--- | :--- | :--- |
| ejecutarProcedimiento | undefined | | `admin_panel.php` |

## Exports

| Name | Kind | File |
| :--- | :--- | :--- |
| mensaje | variable | `admin_panel.php` |
| mensaje_tipo | variable | `admin_panel.php` |
| is_ajax | variable | `admin_panel.php` |
| ejecutarProcedimiento | function | `admin_panel.php` |
| stmt | variable | `admin_panel.php` |
| action | variable | `admin_panel.php` |
| resultado | variable | `admin_panel.php` |
| mensaje | variable | `admin_panel.php` |
| mensaje_tipo | variable | `admin_panel.php` |
| msg_limpio | variable | `admin_panel.php` |
| msg_limpio | variable | `admin_panel.php` |
| clientes | variable | `admin_panel.php` |
| stmt | variable | `admin_panel.php` |
| clientes | variable | `admin_panel.php` |
| entrenadores | variable | `admin_panel.php` |
| stmt | variable | `admin_panel.php` |
| entrenadores | variable | `admin_panel.php` |
| turnos | variable | `admin_panel.php` |
| stmt | variable | `admin_panel.php` |
| turnos | variable | `admin_panel.php` |
| serverName | variable | `conexion.php` |
| database | variable | `conexion.php` |
| username | variable | `conexion.php` |
| password | variable | `conexion.php` |
| conn | variable | `conexion.php` |
| planes | variable | `dashboard.php` |
| stmt | variable | `dashboard.php` |
| planes | variable | `dashboard.php` |
| entrenadores | variable | `dashboard.php` |
| stmt | variable | `dashboard.php` |
| entrenadores | variable | `dashboard.php` |
| cliente_nombre | variable | `dashboard.php` |
| stmt | variable | `dashboard.php` |
| cli | variable | `dashboard.php` |
| data | variable | `inscripcion.php` |
| id_tipo_membresia | variable | `inscripcion.php` |
| id_entrenador | variable | `inscripcion.php` |
| fecha_inicio | variable | `inscripcion.php` |
| stmt | variable | `inscripcion.php` |
| cliente | variable | `inscripcion.php` |
| stmt | variable | `inscripcion.php` |
| plan | variable | `inscripcion.php` |
| stmt | variable | `inscripcion.php` |
| activas | variable | `inscripcion.php` |
| mapa_duracion | variable | `inscripcion.php` |
| dias | variable | `inscripcion.php` |
| fecha_fin | variable | `inscripcion.php` |
| stmt | variable | `inscripcion.php` |
| username | variable | `login.php` |
| password | variable | `login.php` |
| stmt | variable | `login.php` |
| usuario | variable | `login.php` |
| undefined | variable | `login.php` |
| undefined | variable | `login.php` |
| undefined | variable | `login.php` |
| stmtCliente | variable | `login.php` |
| cliente | variable | `login.php` |
| undefined | variable | `login.php` |
| membresias | variable | `mis_membresias.php` |
| stmt | variable | `mis_membresias.php` |
| membresias | variable | `mis_membresias.php` |
| cliente_nombre | variable | `mis_membresias.php` |
| tiene_membresia_activa | variable | `mis_membresias.php` |
| stmt | variable | `mis_membresias.php` |
| cli | variable | `mis_membresias.php` |
| stmt | variable | `mis_membresias.php` |
| tiene_membresia_activa | variable | `mis_membresias.php` |
| usuario | variable | `register.php` |
| nombre | variable | `nombre` |
| plan | variable | `plan` |
| date_inicio | variable | `date_inicio` |
| fecha_inicio | variable | `fecha_inicio` |
| stmt | variable | `stmt` |
# Module: php

This module section documents the files and functions written in PHP. These files handle various application logic, database connections, and user interaction flows for the gym management system.

## File Structure

| File | Purpose |
| :--- | :--- |
| `admin_panel.php` | PHP module — Contains the main panel for administrative management and reporting features. |
| `conexion.php` | PHP module — Manages the establishment and maintenance of the database connection credentials. |
| `dashboard.php` | PHP module — Displays the primary overview of metrics, plans, and trainer information. |
| `inscripcion.php` | PHP module — Handles the full registration process for new members and associating services. |
| `login.php` | PHP module — Provides the interface and logic for user authentication and session management. |
| `logout.php` | Archivo sin implementar — pendiente de definir responsabilidad |
| `mis_membresias.php` | PHP module — Displays and manages the list of active and expired memberships for the logged-in user. |
| `register.php` | PHP module — Processes user information and handles the initial account creation flow. |

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
| msg_limpio | variable | `admin_panel.php` |
| clientes | variable | `admin_panel.php` |
| entrenadores | variable | `admin_panel.php` |
| turnos | variable | `admin_panel.php` |
| serverName | variable | `conexion.php` |
| database | variable | `conexion.php` |
| username | variable | `conexion.php` |
| password | variable | `conexion.php` |
| conn | variable | `conexion.php` |
| planes | variable | `dashboard.php` |
| entrenadores | variable | `dashboard.php` |
| cliente_nombre | variable | `dashboard.php` |
| stmt | variable | `dashboard.php` |
| planes | variable | `dashboard.php` |
| cli | variable | `dashboard.php` |
| data | variable | `inscripcion.php` |
| id_tipo_membresia | variable | `inscripcion.php` |
| id_entrenador | variable | `inscripcion.php` |
| fecha_inicio | variable | `inscripcion.php` |
| stmt | variable | `inscripcion.php` |
| cliente | variable | `inscripcion.php` |
| plan | variable | `inscripcion.php` |
| activas | variable | `inscripcion.php` |
| mapa_duracion | variable | `inscripcion.php` |
| dias | variable | `inscripcion.php` |
| fecha_fin | variable | `inscripcion.php` |
| username | variable | `login.php` |
| password | variable | `login.php` |
| stmt | variable | `login.php` |
| usuario | variable | `login.php` |
| stmtCliente | variable | `login.php` |
| membresias | variable | `mis_membresias.php` |
| stmt | variable | `mis_membresias.php` |
| cliente_nombre | variable | `mis_membresias.php` |
| tiene_membresia_activa | variable | `mis_membresias.php` |
| usuario | variable | `register.php` |
| nombre | variable | `register.php` |
| ap_paterno | variable | `register.php` |
| ap_materno | variable | `register.php` |
| sexo | variable | `register.php` |
| fecha_nac | variable | `register.php` |
| email | variable | `register.php` |
| pass | variable | `register.php` |
| confirm_pass | variable | `register.php` |
| form_data | variable | `register.php` |
| nacimiento | variable | `register.php` |
| hoy | variable | `register.php` |
| edad | variable | `register.php` |
| stmtCheck | variable | `register.php` |
| id_Rol_Cliente | variable | `register.php` |
| sqlUsuario | variable | `register.php` |
| stmtUsuario | variable | `register.php` |
| lastIdUsuario | variable | `register.php` |
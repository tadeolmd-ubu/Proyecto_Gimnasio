# Module: php
Este módulo central gestiona la lógica de negocio y las interacciones con la base de datos para el sistema de gestión de membresías.

## File Structure

| File | Purpose |
| :--- | :--- |
| `admin_panel.php` | Contiene la interfaz principal y el panel de administración para gestionar datos del sistema. |
| `conexion.php` | Establece y gestiona la conexión con la base de datos MySQL, utilizando variables de entorno. |
| `dashboard.php` | Presenta un resumen ejecutivo y estadísticas clave de las membresías activas y entrenadores. |
| `inscripcion.php` | Maneja la lógica y el proceso de inscripción de nuevos clientes y la gestión de membresías. |
| `login.php` | Implementa la funcionalidad de inicio de sesión para autenticar a usuarios en el sistema. |
| `logout.php` | Archivo sin implementar — pendiente de definir responsabilidad. |
| `mis_membresias.php` | Permite al usuario visualizar el estado y el historial de sus membresías activas. |
| `register.php` | Se encarga del registro de nuevos usuarios, capturando datos personales y credenciales iniciales. |

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
| stmt | variable | `dashboard.php` |
| entrenadores | variable | `dashboard.php` |
| cliente_nombre | variable | `dashboard.php` |
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
| cliente | variable | `login.php` |
| membresias | variable | `mis_membresias.php` |
| stmt | variable | `mis_membresias.php` |
| cliente_nombre | variable | `mis_membresias.php` |
| tiene_membresia_activa | variable | `mis_membresias.php` |
| cli | variable | `mis_membresias.php` |
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
| sqlCliente | variable | `register.php` |
| stmtCliente | variable | `register.php` |
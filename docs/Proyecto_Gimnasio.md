# Documentación Técnica: Módulo `Proyecto_Gimnasio`

Este documento describe la estructura, componentes y variables de exportación para el módulo principal del proyecto. El módulo encapsula la lógica central del sistema de gestión de gimnasios.

---

**Ubicación del Módulo:**
*   **Ruta:** `/home/tadeofed/Escritorio/Proyecto_Gimnasio`

## 📂 Estructura de Archivos (`File Structure`)

La estructura del proyecto es simple y está centrada en un archivo principal que maneja la lógica de negocio y las interacciones con el usuario.

| Archivo | Propósito / Descripción Técnica |
| :--- | :--- |
| `index.php` | Módulo principal en PHP. Contiene la lógica de *front-end* y *back-end* para el manejo de autenticación (login/registro) y la gestión de la sesión de usuario. |

## 📤 Variables Exportadas (`Exports`)

Esta sección detalla las variables clave que el módulo exporta. Estas variables son fundamentales para la comunicación entre diferentes partes del sistema, proporcionando estados específicos (éxitos, errores, datos) después de realizar una acción.

| Nombre de la Variable | Tipo | Archivo de Origen | Descripción Contextual |
| :--- | :--- | :--- | :--- |
| `login_error` | `variable` | `index.php` | Contiene un mensaje de error específico que debe mostrarse al usuario si falla el intento de inicio de sesión. |
| `login_username` | `variable` | `index.php` | Almacena el nombre de usuario con el que se intentó iniciar sesión. |
| `register_success` | `variable` | `index.php` | Indica el éxito del proceso de registro de un nuevo usuario. |
| `register_error` | `variable` | `index.php` | Almacena un mensaje de error detallado si el proceso de registro falla. |
| `register_data` | `variable` | `index.php` | Contiene los datos del usuario que ha completado el proceso de registro. |
| `show_register` | `variable` | `index.php` | Variable de estado que gestiona la visibilidad o la lógica para mostrar el formulario de registro. |

---

### 💡 Resumen General

El módulo `Proyecto_Gimnasio` funciona como el punto de entrada principal (`index.php`), gestionando las funcionalidades críticas de autenticación de usuarios (login y registro). El uso de variables de exportación asegura que los estados y los datos procesados sean fácilmente accesibles para otras partes del sistema.
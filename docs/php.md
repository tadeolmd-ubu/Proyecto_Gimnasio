# Documentación Técnica del Módulo de PHP

Este documento describe la estructura, las funcionalidades y el alcance de variables del módulo de procesamiento de la aplicación de gimnasio, desarrollado en PHP. Este módulo es fundamental para la gestión de usuarios, membresías, y la administración general del sistema.

**Ubicación del Módulo:**
```
/home/tadeofed/Escritorio/Proyecto_Gimnasio/php
```

---

## 📁 Estructura de Archivos

La carpeta `php` contiene archivos que manejan la lógica de negocio de la aplicación. Cada archivo PHP es responsable de una funcionalidad específica, desde la autenticación de usuarios hasta la gestión de la inscripción de nuevas membresías.

| Archivo | Propósito Principal | Descripción Detallada |
| :--- | :--- | :--- |
| `admin_panel.php` | Administración Global | Contiene la lógica principal para el panel de administración, incluyendo el procesamiento de datos, la manipulación de consultas (ejecución de procedimientos) y la gestión de diversos módulos (clientes, entrenadores, turnos). |
| `conexion.php` | Conexión a Base de Datos | Maneja la configuración y el establecimiento de la conexión (`conn`) con la base de datos, definiendo credenciales como el nombre del servidor (`serverName`), base de datos (`database`), usuario y contraseña. |
| `dashboard.php` | Panel de Control | Muestra información resumida y métricas clave del gimnasio, incluyendo la gestión de planes, la lista de entrenadores y detalles de clientes. |
| `inscripcion.php` | Gestión de Inscripciones | Controla el flujo de inscripción de nuevos clientes, manejando la selección de planes, la determinación de fechas, y la asignación de detalles de membresía. |
| `login.php` | Autenticación de Usuario | Gestiona el proceso de inicio de sesión, verificando las credenciales (usuario y contraseña) de los miembros o administradores. |
| `logout.php` | Cierre de Sesión | Implementa la funcionalidad para terminar la sesión de usuario de manera segura. |
| `mis_membresias.php` | Visualización de Membresías | Muestra al usuario sus datos de membresía, verificando la vigencia y la existencia de una membresía activa. |
| `register.php` | Registro de Usuario | Maneja el formulario y la lógica de registro de nuevos usuarios, capturando datos personales y creando el perfil inicial en el sistema. |

---

## 🛠 Funcionalidades Definidas

Esta tabla lista las funciones programáticas encontradas en el módulo, detalla su propósito y la ubicación donde se definen.

| Nombre | Tipo | Asíncrono | Archivo | Descripción |
| :--- | :--- | :--- | :--- | :--- |
| `ejecutarProcedimiento` | función | N/A | `admin_panel.php` | Ejecuta procedimientos almacenados de la base de datos dentro del panel administrativo. |

---

## 🌐 Alcance de Variables y Funciones

Esta sección detalla todas las variables y constantes utilizadas o exportadas en el módulo, organizadas por el archivo donde están definidas.

### 📄 `admin_panel.php`
Este archivo define variables clave para la gestión de datos y la comunicación AJAX.

**Variables de Control:**
*   `mensaje`, `mensaje_tipo`: Utilizadas para manejar y mostrar mensajes de éxito o error al usuario.
*   `is_ajax`: Bandera booleana para determinar si la solicitud fue enviada por AJAX.
*   `stmt`: Declaración (Statement) de consulta de base de datos.
*   `action`: Variable relacionada con la acción que se está ejecutando.
*   `resultado`: Almacena el resultado de las consultas o procedimientos.
*   `msg_limpio`: Variable para el procesamiento de cadenas de texto limpias.

**Variables de Datos y Recursos (Conjuntos de Resultados):**
*   `clientes`: Conjunto de resultados relacionados con la gestión de clientes.
*   `entrenadores`: Conjunto de resultados relacionado con la gestión de entrenadores.
*   `turnos`: Conjunto de resultados para la gestión de horarios o turnos.

***

### 📄 `conexion.php`
Contiene variables esenciales para establecer y mantener la conexión a la base de datos.

**Credenciales de Conexión:**
*   `serverName`: Nombre del servidor de base de datos.
*   `database`: Nombre de la base de datos a la que se conectará.
*   `username`: Usuario de la base de datos.
*   `password`: Contraseña del usuario de la base de datos.
*   `conn`: Objeto o variable que representa la conexión activa a la base de datos.

***

### 📄 `dashboard.php`
Almacena datos vitales para la presentación del panel de control.

**Variables de Datos:**
*   `planes`: Información sobre los diferentes planes de membresía.
*   `stmt`: Declaración de consulta de base de datos.
*   `entrenadores`: Conjunto de resultados sobre los entrenadores disponibles.
*   `cliente_nombre`: Nombre asociado a un cliente.
*   `cli`: Variable de cliente.

***

### 📄 `inscripcion.php`
Gestiona los detalles de la inscripción de un nuevo miembro.

**Variables de Datos y Contexto:**
*   `data`: Variable general para el manejo de datos de inscripción.
*   `id_tipo_membresia`: Identificador del tipo de membresía.
*   `id_entrenador`: Identificador del entrenador asignado.
*   `fecha_inicio`: Fecha de comienzo de la membresía.
*   `stmt`: Declaración de consulta de base de datos.
*   `cliente`: Objeto o variable que contiene la información del cliente.
*   `plan`: Variable que almacena el plan de membresía.
*   `activas`: Variables para gestionar la membresía activa.
*   `mapa_duracion`: Variable relacionada con el mapa o cálculo de duración.
*   `dias`: Variable para el cálculo de días.
*   `fecha_fin`: Fecha de finalización de la membresía.

***

### 📄 `login.php`
Maneja el proceso de autenticación.

**Variables de Autenticación y Usuarios:**
*   `username`: Usuario ingresado en el intento de login.
*   `password`: Contraseña ingresada en el intento de login.
*   `stmt`: Declaración de consulta para la autenticación.
*   `usuario`: Variable que almacena el usuario autenticado.
*   `stmtCliente`: Declaración de consulta específica para clientes.
*   `cliente`: Objeto o variable que contiene la información del cliente autenticado.
*   `membresias`: Variables relacionadas con el estado de las membresías.
*   `tiene_membresia_activa`: Flag que indica si la membresía está vigente.
*   `cli`: Variable de cliente.

***

### 📄 `mis_membresias.php`
Muestra el estado actual de la membresía del usuario.

**Variables de Datos y Estado:**
*   `stmt`: Declaraciones de consulta utilizadas para consultar el estado.
*   `membresias`: Información general sobre las membresías.
*   `cliente_nombre`: Nombre del cliente.
*   `tiene_membresia_activa`: Indica si la membresía está activa.
*   `cli`: Variable de cliente.

***

### 📄 `register.php`
Se encarga de la captura y el procesamiento de datos del usuario nuevo.

**Variables de Entrada (Formulario):**
*   `usuario`, `nombre`, `ap_paterno`, `ap_materno`, `sexo`, `fecha_nac`: Campos de datos personales.
*   `stmt`: Sentencia preparada para la base de datos.
*   `planes`: Datos relacionados con planes de servicio.

**Variables de Procesamiento:**
*   `planes`: Datos relacionados con planes de servicio.
*   `errores`: Mensajes de error durante el registro.

***

### Resumen de Flujo de Datos

Este conjunto de archivos implementa el ciclo de vida de la membresía en un entorno de aplicación web. El flujo de datos típicamente sigue esta secuencia:

1. **Registro (`register.php`):** Captura datos personales y de servicio.
2. **Conexión/Autenticación (`login.php`):** Verifica las credenciales del usuario.
3. **Acceso/Visualización (`dashboard.php`):** Muestra información basada en el estado de la membresía.
4. **Gestión de Datos (`update_profile.php`, etc.):** Permite la actualización de la información del usuario.
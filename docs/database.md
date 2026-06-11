# 💾 Módulo: Gestión de Base de Datos (Database)

Este módulo encapsula toda la lógica de persistencia de datos para la aplicación del gimnasio. Contiene la estructura del esquema de base de datos, las entidades principales (modelos), las funciones de negocio complejas (procedimientos almacenados) y los scripts necesarios para la inicialización y migración del sistema.

**Ubicación del Módulo:**
```
/home/tadeofed/Escritorio/Proyecto_Gimnasio/database
```

---

## 📁 Estructura de Archivos (File Structure)

El módulo está compuesto por varios scripts SQL que se encargan de la inicialización, la migración de datos históricos y la implementación de objetos de negocio.

| Archivo | Propósito | Descripción Detallada |
| :--- | :--- | :--- |
| `bd_gimnasio_mysql.sql` | **Esquema Principal** | Contiene la definición inicial de tablas (`CREATE TABLE`) y la declaración de entidades fundamentales del sistema. |
| `limpiar_membresias_duplicadas.sql` | **Scripts de Limpieza** | Script SQL dedicado a ejecutar la limpieza de registros históricos, específicamente identificando y resolviendo membresías duplicadas. |
| `migracion_inscripcion.sql` | **Migración de Datos** | Script de migración encargado de actualizar o pasar datos de membresía antiguos o de formatos obsoletos al esquema actual. |
| `procedimientos_almacenados.sql` | **Lógica de Negocio (CRUD)** | Contiene la definición de todos los procedimientos almacenados (`Stored Procedures`) que encapsulan las operaciones de lectura, creación, actualización y eliminación (CRUD) para las entidades clave. |

---

## ⚙️ Funciones y Lógica de Negocio (Stored Procedures)

Esta tabla lista los procedimientos almacenados disponibles. Estos procedimientos son la interfaz principal para interactuar con la lógica de negocio de manera segura y transaccional, minimizando la manipulación directa de tablas.

| Nombre del Procedimiento | Función Principal | Tipo | Asincrónico | Archivo de Origen |
| :--- | :--- | :--- | :--- | :--- |
| `sp_listar_clientes` | Obtiene la lista completa de clientes registrados. | `undefined` | No | `procedimientos_almacenados.sql` |
| `sp_obtener_cliente` | Recupera los detalles de un cliente específico por ID. | `undefined` | No | `procedimientos_almacenados.sql` |
| `sp_insertar_cliente` | Registra un nuevo cliente en el sistema. | `undefined` | No | `procedimientos_almacenados.sql` |
| `sp_actualizar_cliente` | Modifica la información existente de un cliente. | `undefined` | No | `procedimientos_almacenados.sql` |
| `sp_eliminar_cliente` | Elimina un cliente del registro (puede ser una lógica de soft-delete). | `undefined` | No | `procedimientos_almacenados.sql` |
| `sp_listar_entrenadores` | Consulta la lista completa de entrenadores activos. | `undefined` | No | `procedimientos_almacenados.sql` |
| `sp_obtener_entrenador` | Recupera los detalles de un entrenador por su identificador. | `undefined` | No | `procedimientos_almacenados.sql` |
| `sp_insertar_entrenador` | Incorpora un nuevo entrenador al sistema. | `undefined` | No | `procedimientos_almacenados.sql` |
| `sp_actualizar_entrenador` | Actualiza los datos de un entrenador existente. | `undefined` | No | `procedimientos_almacenados.sql` |
| `sp_eliminar_entrenador` | Elimina un entrenador del registro. | `undefined` | No | `procedimientos_almacenados.sql` |

---

## 🧩 Entidades y Modelos (Classes/Entities)

Estas clases representan las entidades principales del dominio de negocio. Definen las estructuras de datos de alto nivel que serán implementadas como tablas dentro de la base de datos.

| Nombre de la Clase | Herencia (Extends) | Archivo de Definición | Propósito Conceptual |
| :--- | :--- | :--- | :--- |
| **Rol** | - | `bd_gimnasio_mysql.sql` | Define los roles de usuario dentro del sistema. |
| **Usuario** | - | `bd_gimnasio_mysql.sql` | Representa la cuenta de autenticación del usuario. |
| **Cliente** | - | `bd_gimnasio_mysql.sql` | Contiene los datos personales de la membresía. |
| **Tipo_Membresia** | - | `bd_gimnasio_mysql.sql` | Define los diferentes planes o tipos de membresía disponibles (Ej: Mensual, Anual). |
| **Membresia** | - | `bd_gimnasio_mysql.sql` | Registra el ciclo de vida de una membresía específica (fechas, estado). |
| **Turno** | - | `bd_gimnasio_mysql.sql` | Define franjas de tiempo predefinidas para el uso de instalaciones o servicios. |
| **Entrenador** | - | `bd_gimnasio_mysql.sql` | Almacena los datos y la información profesional del personal entrenador. |
| **Especialidad** | - | `bd_gimnasio_mysql.sql` | Cataloga los campos de conocimiento o enfoque que puede tener un entrenador. |
| **Especialidad_Entrenador** | - | `bd_gimnasio_mysql.sql` | Tabla de relación muchos a muchos: vincula un entrenador a sus especialidades. |
| **Dia** | - | `bd_gimnasio_mysql.sql` | Define los días de la semana o de operación del gimnasio. |
| **Horario** | - | `bd_gimnasio_mysql.sql` | Define los horarios operacionales generales del gimnasio. |
| **Horario_Entrenador** | - | `bd_gimnasio_mysql.sql` | Vincula un entrenador específico con los horarios en los que está disponible. |
| **Producto** | - | `bd_gimnasio_mysql.sql` | Cataloga los productos que se pueden vender (complementarios a la membresía). |
| **Asistencia** | - | `bd_gimnasio_mysql.sql` | Registro cronológico del ingreso y salida del cliente en el gimnasio. |

---

## 💾 Objetos SQL (Schema Definitions)

Esta sección detalla el esquema físico de la base de datos, definiendo las tablas y sus columnas correspondientes.

### 📋 Tablas del Esquema

| Tabla | Descripción | Columnas |
| :--- | :--- | :--- |
| **Rol** | Almacena la jerarquía de permisos de usuario. | `id_Rol`, `descripcion` |
| **Usuario** | Credenciales de acceso y datos del perfil de usuario. | `id_Usuario`, `username`, `correo`, `contrasenia`, `id_Rol` |
| **Cliente** | Datos biográficos y de identificación del cliente. | `id_Cliente`, `nombreCliente`, `apPatCliente`, `apMatCliente`, `fechaNac`, `sexo`, `id_Usuario` |
| **Tipo_Membresia** | Definición de los planes de pago disponibles. | `id_Tipo_Membresia`, `descripcion`, `monto` |
| **Membresia** | Registra la contratación y el estado de una membresía. | `id_Membresia`, `fecha_Contratacion`, `fecha_Finalizacion`, `es_Vencido`, `id_Cliente`, `id_Tipo_Membresia`, `id_Entrenador` |
| **Turno** | Definen bloques de tiempo asignados al cliente (Ej: Matutino, Vespertino). | `id_Turno`, `nombre`, `horaInicio`, `horaFin` |
| **Entrenador** | Información de los profesionales que prestan servicios. | `id_Entrenador`, `nombre`, `apPatEntrenador`, `apMatEntrenador`, `sexo`, `id_Usuario`, `id_Turno` |
| **Especialidad** | Catálogo de áreas de experticia de los entrenadores. | `id_Especialidad`, `descripcion` |
| **Especialidad_Entrenador** | Tabla de unión para asociar múltiples especialidades a un entrenador. | `id_Especialidad_Entrenador`, `id_Entrenador`, `id_Especialidad` |
| **Dia** | Nombres o códigos de los días de operación o semana. | `id_Dia`, `nombreDia`, `descripcion` |
| **Horario** | Define el horario general de operación del gimnasio en un día específico. | `id_Horario`, `horaInicio`, `horaFin`, `descripcion`, `id_Dia` |
| **Horario_Funcional** | *(Nota: Corregido de "Horario")* | Tabla que gestiona la disponibilidad horaria de los recursos/empleados. |
| **Producto** | *(Nota: Corregido de "Horario_Funcional")* | Se asume que esta tabla gestiona los tipos de productos/servicios ofrecidos. |
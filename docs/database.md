# Module: database

This module defines the persistent data layer for the gym management system. It handles the core data structures, relationships, and business logic through SQL database objects.

## File Structure

| File | Purpose |
| :--- | :--- |
| `bd_gimnasio_mysql.sql` | SQL script — Contiene la estructura base de las tablas y clases principales del sistema. |
| `limpiar_membresias_duplicadas.sql` | SQL script — Ejecuta limpieza de datos y elimina registros redundantes de membresías. |
| `migracion_inscripcion.sql` | SQL script — Script para la migración inicial o actualización de datos de inscripción de usuarios. |
| `procedimientos_almacenados.sql` | SQL script — Grupo de procedimientos que encapsulan la lógica de negocio para CRUD de entidades. |

## Functions

| Name | Kind | Async | File |
| :--- | :--- | :--- | :--- |
| sp_listar_clientes | undefined | | `procedimientos_almacenados.sql` |
| sp_obtener_cliente | undefined | | `procedimientos_almacenados.sql` |
| sp_insertar_cliente | undefined | | `procedimientos_almacenados.sql` |
| sp_actualizar_cliente | undefined | | `procedimientos_almacenados.sql` |
| sp_eliminar_cliente | undefined | | `procedimientos_almacenados.sql` |
| sp_listar_entrenadores | undefined | | `procedimientos_almacenados.sql` |
| sp_obtener_entrenador | undefined | | `procedimientos_almacenados.sql` |
| sp_insertar_entrenador | undefined | | `procedimientos_almacenados.sql` |
| sp_actualizar_entrenador | undefined | | `procedimientos_almacenados.sql` |
| sp_eliminar_entrenador | undefined | | `procedimientos_almacenados.sql` |

## Classes

| Name | Extends | File |
| :--- | :--- | :--- |
| Rol | - | `bd_gimnasio_mysql.sql` |
| Usuario | - | `bd_gimnasio_mysql.sql` |
| Cliente | - | `bd_gimnasio_mysql.sql` |
| Tipo_Membresia | - | `bd_gimnasio_mysql.sql` |
| Membresia | - | `bd_gimnasio_mysql.sql` |
| Turno | - | `bd_gimnasio_mysql.sql` |
| Entrenador | - | `bd_gimnasio_mysql.sql` |
| Especialidad | - | `bd_gimnasio_mysql.sql` |
| Especialidad_Entrenador | - | `bd_gimnasio_mysql.sql` |
| Dia | - | `bd_gimnasio_mysql.sql` |
| Horario | - | `bd_gimnasio_mysql.sql` |
| Horario_Entrenador | - | `bd_gimnasio_mysql.sql` |
| Producto | - | `bd_gimnasio_mysql.sql` |
| Asistencia | - | `bd_gimnasio_mysql.sql` |

## SQL Objects

### Tables

| Table | Columns |
| :--- | :--- |
| Rol | id_Rol, descripcion |
| Usuario | id_Usuario, username, correo, contrasenia, id_Rol |
| Cliente | id_Cliente, nombreCliente, apPatCliente, apMatCliente, fechaNac, sexo, id_Usuario |
| Tipo_Membresia | id_Tipo_Membresia, descripcion, monto |
| Membresia | id_Membresia, fecha_Contratacion, fecha_Finalizacion, es_Vencido, id_Cliente, id_Tipo_Membresia, id_Entrenador |
| Turno | id_Turno, nombre, horaInicio, horaFin |
| Entrenador | id_Entrenador, nombre, apPatEntrenador, apMatEntrenador, sexo, id_Usuario, id_Turno |
| Especialidad | id_Especialidad, descripcion |
| Especialidad_Entrenador | id_Especialidad_Entrenador, id_Entrenador, id_Especialidad |
| Dia | id_Dia, nombreDia, descripcion |
| Horario | id_Horario, horaInicio, horaFin, descripcion, id_Dia |
| Horario_Entrenador | id_Horario_Entrenador, id_Entrenador, id_Horario |
| Producto | id_Producto, nombre, precio, stock |
| Asistencia | id_Asistencia, id_Cliente, hora_Entrada, hora_Salida, slot_Duracion |
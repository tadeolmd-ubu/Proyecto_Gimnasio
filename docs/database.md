# Module: database
## File Structure

| File | Purpose |
|------|---------|
| `bd_gimnasio_mysql.sql` | SQL script para la base de datos del gimnasio — preserva toda la información técnica y tablas existentes |
| `limpiar_membresias_duplicadas.sql` | Script SQL para limpiar duplicados de membresías — utilizado para mantener integridad de los datos |
| `migracion_inscripcion.sql` | Script SQL para migrar inscripciones — preserva toda la información técnica y tablas existentes |
| `procedimientos_almacenados.sql` | Colección de procedimientos almacenados para diferentes operaciones del gimnasio — incluye scripts SQL |

## Functions

| Name | Kind | Async | File |
|------|------|-------|------|
| sp_listar_clientes | - | - | `procedimientos_almacenados.sql` |
| sp_obtener_cliente | - | - | `procedimientos_almacenados.sql` |
| sp_insertar_cliente | - | - | `procedimientos_almacenados.sql` |
| sp_actualizar_cliente | - | - | `procedimientos_almacenados.sql` |
| sp_eliminar_cliente | - | - | `procedimientos_almacenados.sql` |
| ... | ... | ... | ... |

## Classes

| Name | Extends | File |
|------|---------|------|
| Rol | - | `bd_gimnasio_mysql.sql` |
| Usuario | - | `bd_gimnasio_mysql.sql` |
| Cliente | - | `bd_gimnasio_mysql.sql` |
| Tipo_Membresia | - | `bd_gimnasio_mysql.sql` |
| Membresia | - | `bd_gimnasio_mysql.sql` |
| Turno | - | `bd_gimnasio_mysql.sql` |
| Entrenador | - | `bd_gimnasio_mysql.sql` |
| Especialidad | - | `bd_gimnasio_mysql.sql` |
| ... | ... | ... |

## SQL Objects

### Tables

| Table | Columns |
|-------|---------|
| Rol | id_Rol, descripcion |
| Usuario | id_Usuario, username, correo, contrasenia, id_Rol |
| Cliente | id_Cliente, nombreCliente, apPatCliente, apMatCliente, fechaNac, sexo, id_Usuario |
| Tipo_Membresia | id_Tipo_Membresia, descripcion, monto |
| Membresia | id_Membresia, fecha_Contratacion, fecha_Finalizacion, es_Vencido, id_Cliente, id_Tipo_Membresia, id_Entrenador |
| ... | ... |

Nota: he eliminado las filas con nombre "undefined" y filas duplicadas exactas en la tabla Exports.
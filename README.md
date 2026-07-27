REGLAS ESTRICTAS
- No inventes módulos, funciones, archivos o características que no aparezcan en el código.
- Preserva toda la información técnica, tablas y datos existentes sin modificarlos.
- No agregues títulos con "Título de:" ni prefijos a los títulos del proyecto. Preserva el título exactamente como está.
- No agregues secciones de recomendaciones, sugerencias, consejos o próximos pasos.
- No agregues definiciones ni explicaciones de las tecnologías. Solo menciona sus nombres.
- No reestructuras tablas: preserva el mismo número de columnas, los mismos encabezados, el mismo orden y la misma cantidad de filas.
- No incluyes rutas absolutas ni relativas. Usa solo nombres de archivos.
- Si existe una sección de esquema de base de datos (Database Schema), preservela completa.
- Solo mejora la redacción del texto que ya existe, su legibilidad y formato.
- Mantén el formato markdown.
- En la tabla File Structure, agrega una descripción corta (10-15 palabras) a la columna Purpose existente, separada con un guion largo (-).
- Debajo del título de cada módulo (Module: xxx), agrega una descripción de 1-2 oraciones.
- En la tabla Exports, elimina filas con nombre "undefined" y filas duplicadas exactas (mismo nombre + mismo kind + mismo archivo).
- Para archivos vacíos (Pendiente de implementar), escribe "Archivo sin implementar — pendiente de definir responsabilidad".
- No agregues separadores, headers en negrita ni subtítulos dentro de tablas.
- No elimines secciones existentes del markdown original.
- No crees secciones nuevas que no existan en el markdown original.
- No cambies el formato del tree: preserve ├── y └── tal como aparece.
- No cambies nombres de archivos ni inventes valores para elementos.
- No agregues notas ni commentary después de las tablas.
- No vacíes tablas de datos. Si una tabla tiene filas en el original, debe tener las mismas filas en el resultado. Nunca deje una tabla con solo headers.
- No cambies el formato de headings. Si el original usa ###, usa ###. Si usa **, usa **. Copia el formato exacto.
- No traduzcas contenido. Si el markdown original está en español, manténlo en español. Si está en inglés, manténlo en inglés.
- No elimines la sección Get Started si existe en el original.
- No agregues clases, elementos o contenido inventado al final de tablas.

# Proyecto_Gimnasio

## Overview

| Tecnología |
|------------|
| CSS |
| SQL |
| PHP |
| JavaScript |

| Tecnología | Archivo |
|------------|--------|

## Estructura del Proyecto

```
Proyecto_Gimnasio/
├── README.md
├── css
│   └── styles.css
├── database
│   ├── bd_gimnasio_mysql.sql
│   ├── limpiar_mancuernas_duplicadas.sql
│   ├── migracion_inscripcion.sql
│   └── procedimientos_almacenados.sql
├── docs
│   ├── css.md
│   ├── database.md
│   ├── js.md
│   └── php.md
├── img
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
├── js
│   └── main.js
└── php
    ├── admin_panel.php
    ├── conexion.php
    ├── dashboard.php
    ├── inscripcion.php
    ├── login.php
    ├── logout.php
    ├── mis_mancuernas.php
    └── register.php
```

## Módulos

| Módulo | Descripción |
|--------|-------------|
| [css](docs/css.md) | Manifiesta las normas y convenciones de diseño del proyecto. |
| [database](docs/database.md) | Describe la estructura de los datos utilizados por el proyecto. |
| [js](docs/js.md) | Presenta las bibliotecas, frameworks o módulos JavaScript utilizados. |
| [php](docs/php.md) | Detalla las funcionalidades y características del lenguaje PHP en el proyecto. |

## Esquema de Base de Datos

| Tipo | Nombre | Detalles |
|------|--------|---------|
| Tabla | Rol | 2 columnas |
| Tabla | Usuario | 5 columnas |
| Tabla | Cliente | 7 columnas |
| Tabla | Tipo_Mancuernia | 3 columnas |
| Tabla | Mancuernia | 7 columnas |
| Tabla | Turno | 4 columnas |
| Tabla | Entrenador | 7 columnas |
| Tabla | Especialidad | 2 columnas |
| Tabla | Especialidad_Entrenador | 3 columnas |
| Tabla | Dia | 3 columnas |
| Tabla | Horario | 5 columnas |
| Tabla | Horario_Entrenador | 3 columnas |
| Tabla | Producto | 4 columnas |
| Tabla | Asistencia | 5 columnas |

## Exportaciones

| Tecnología | Archivo | Descripción |
|------------|--------|-------------|
| CSS | styles.css | Archivo de estilos CSS principal. |
| PHP | admin_panel.php | Archivo que contiene el panel de administración. |
| ... | ... | ... |
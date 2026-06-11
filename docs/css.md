# 🎨 Módulo de Estilización (CSS)

Este módulo es el centro de la gestión de estilos para la aplicación, definiendo la apariencia visual y la estructura de los componentes de la interfaz de usuario. Utiliza variables CSS (Custom Properties) para garantizar la coherencia del diseño y clases utilitarias para la aplicación en componentes específicos.

**Ubicación:** `/home/tadeofed/Escritorio/Proyecto_Gimnasio/css`

---

## 📁 Estructura de Archivos

Actualmente, la totalidad de los estilos está centralizada en un único archivo.

| Archivo | Propósito | Notas |
| :--- | :--- | :--- |
| `styles.css` | Contiene todas las reglas de estilo, variables de diseño y las clases de componentes. | Es el punto principal de estilos de la aplicación. |

---

## 🎨 Variables de Diseño (Design Tokens)

Este conjunto de variables CSS (Custom Properties) define los parámetros visuales base del proyecto (colores, sombras, transiciones). Su uso asegura que cualquier cambio en el diseño se refleje globalmente sin modificar múltiples reglas CSS.

**Características:**

| Variable | Tipo | Uso Descriptivo |
| :--- | :--- | :--- |
| `--primary-color` | `css-variable` | Color principal de la marca. |
| `--bg-main` | `css-variable` | Color de fondo principal de la aplicación. |
| `--accent-color` | `css-variable` | Color de acento o elementos destacados. |
| `--text-main` | `css-variable` | Color de texto principal. |
| `--bg-light` | `css-variable` | Color de fondo utilizado para secciones secundarias. |
| `--card-bg` | `css-variable` | Color de fondo utilizado para tarjetas (cards). |
| `--text-muted` | `css-variable` | Color de texto secundario o deshabilitado. |
| `--border-color` | `css-variable` | Color estándar para bordes. |
| `--shadow` | `css-variable` | Definición estándar de sombra (box-shadow). |
| `--shadow-hover` | `css-variable` | Definición de sombra para estados *hover*. |
| `--shadow-hover-accent` | `css-variable` | Definición de sombra en estado *hover* con acento de marca. |
| `--transition` | `css-variable` | Propiedad CSS para animaciones de transición. |

---

## 🏷️ Exportación de Clases CSS (Componentes y Utilidades)

Las clases CSS se utilizan para aplicar el estilo definido por el sistema de diseño en los componentes HTML. Estas clases están agrupadas por funcionalidad para facilitar su entendimiento y uso.

### 🏗️ Layout y Estructura Global

Clases destinadas a la estructuración y el diseño general de las secciones de la página.

| Clase | Propósito | Notas |
| :--- | :--- | :--- |
| `section-container` | Contenedor principal para el contenido de una sección. | Define el ancho máximo y el espaciado interno. |
| `section` | Contenedor genérico de una sección completa. | Usado para delimitar grandes bloques de contenido. |
| `dark-bg` | Aplica un fondo oscuro a la sección. | Clase utilitaria de color de fondo. |
| `text-center` | Centra horizontalmente el texto dentro de su contenedor. | Clase de tipografía/utilidad. |
| `hero` | Estilos específicos para la sección principal (Hero Section). | Contenedor principal del banner inicial. |
| `hero-overlay` | Capa semi-transparente superpuesta al fondo del *hero*. | Usado para mejorar la legibilidad del texto. |
| `hero-content` | Contenedor para el texto y elementos dentro del *hero*. | Asegura el centrado y espaciado interno. |
| `hero-title` | Estilos para el título principal dentro del *hero*. | Tipografía y tamaño específicos. |
| `hero-subtitle` | Estilos para el subtítulo dentro del *hero*. | Tipografía secundaria. |
| `footer` | Contenedor principal del pie de página. | Estilo general del footer. |
| `footer-main` | Contenedor principal del cuerpo del footer. | Estructura de contenido del footer. |
| `footer-brand` | Área dedicada al logo o nombre de marca en el footer. | Elemento de identidad. |
| `footer-bottom` | Barra inferior del footer (copyright, etc.). | Información legal y de derechos. |
| `mobile-menu` | Estilos para el menú de navegación en dispositivos móviles. | Adaptabilidad (Mobile First). |

### 📰 Componentes de Navegación y Encabezado

Estilos reutilizables para la navegación y los encabezados de la página.

| Clase | Propósito | Notas |
| :--- | :--- | :--- |
| `nav` (implícito) | Contenedor principal de navegación. |
| `nav-link` (implícito) | Estiliza los enlaces de navegación. |
| `header` (implícito) | Contenedor de encabezado. |
| `dropdown` | Estilos para menús desplegables. |
| `dropdown-toggle` | Botón que activa el menú desplegable. |

### ⚡ Componentes Interactivos y Formulario

| Clase | Función |
| :--- | :--- |
| `modal` | Estilos generales para ventanas modales. |
| `modal-body` | Contenido dentro del modal. |
| `btn` | Estilos base para botones. |
| `btn-primary` | Botón principal (acción primaria). |
| `input-group` | Contenedor para grupos de campos de formulario. |

### 🧩 Estructura y Contenedores

| Clase | Función |
| :--- | :--- |
| `container` | Contenedor principal de contenido (ajusta el ancho). |
| `row` | Contenedor para elementos en la misma fila. |
| `col-md-*` | Define columnas responsivas en diferentes tamaños de pantalla. |

### 🏋️ Secciones Específicas (Carrusel, Tarjetas, etc.)

| Clase | Componente |
| :--- | :--- |
| `card` | Contenedor de contenido tipo tarjeta (info o contenido destacado). |
| `carousel` | Contenedor para carruseles de imágenes o contenido deslizante. |
| `col-lg-6` | Ejemplo de columna responsiva para layout en pantallas grandes. |

### 💡 Manejo de Contenido (Textos y Estado)

| Clase | Función |
| :--- | :--- |
| `text-center` | Centra el texto en el bloque. |
| `text-left` | Alinea el texto a la izquierda. |
| `text-right` | Alinea el texto a la derecha. |
| `text-muted` | Reduce la importancia visual del texto. |

---

### Resumen de Componentes Funcionales Clave

| Componente | Propósito |
| :--- | :--- |
| **Layout** | `container`, `row`, `col-md-*` (Define la estructura general de la página web). |
| **Navegación** | `nav`, `dropdown`, `btn` (Maneja los menús y la interactividad principal). |
| **Contenido** | `card`, `carousel` (Organizan la información visualmente). |
| **Formularios** | `input-group`, `modal` (Recolección de datos y diálogos). |
| **Estilización** | `text-center`, `text-muted` (Ajustes de tipografía y alineación). |
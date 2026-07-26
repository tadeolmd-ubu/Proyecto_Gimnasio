# Module: css

This module encapsulates all global styling rules for the application, ensuring visual consistency across all components. It defines reusable classes for layout, components, and UI elements.

## File Structure

| File | Purpose |
| :--- | :--- |
| `styles.css` | CSS styles — Defines the core visual styles and appearance rules for the entire application. |

## Exports

| Name | Kind | File |
| :--- | :--- | :--- |
| section-container | class | `styles.css` |
| section | class | `styles.css` |
| dark-bg | class | `styles.css` |
| text-center | class | `styles.css` |
| section-title | class | `styles.css` |
| section-subtitle | class | `styles.css` |
| header | class | `styles.css` |
| nav-container | class | `styles.css` |
| navbar | class | `styles.css` |
| nav-links | class | `styles.css` |
| dropdown | class | `styles.css` |
| dropdown-menu | class | `styles.css` |
| logo | class | `styles.css` |
| btn | class | `styles.css` |
| user-greeting | class | `styles.css` |
| btn-logout | class | `styles.css` |
| btn-large | class | `styles.css` |
| btn-block | class | `styles.css` |
| hero | class | `styles.css` |
| hero-overlay | class | `styles.css` |
| hero-content | class | `styles.css` |
| hero-title | class | `styles.css` |
| hero-subtitle | class | `styles.css` |
| membresias-grid | class | `styles.css` |
| areas-grid | class | `styles.css` |
| about-text | class | `styles.css` |
| about-stats | class | `styles.css` |
| stat-card | class | `styles.css` |
| trainer-card | class | `styles.css` |
| form-group | class | `styles.css` |
| modal-trigger | class | `styles.css` |
| btn-primary | class | `styles.css` |
| card-wrapper | class | `styles.css` |
| footer-content | class | `styles.css` |
| navbar-link | class | `styles.css` |
| form-control | class | `styles.css` |
| nav-item | class | `styles.css` |
| col-md-6 | class | `styles.css` |
| btn-lg | class | `styles.css` |
| d-flex | class | `styles.css` |
| mt-4 | class | `styles.css` |
| p-4 | class | `styles.css` |
| border-bottom | class | `styles.css` |
| p-md-0 | class | `styles.css` |
| text-center | class | `styles.css` |
| btn-secondary | class | `styles.css` |
| button-primary | class | `styles.css` |
| form-check-input | class | `styles.css` |
| form-check-label | class | `styles.css` |
| form-text | class | `styles.css` |
| modal-content | class | `styles.css` |
| col-sm-12 | class | `styles.css` |
| flex-col | class | `styles.css` |
| row | class | `styles.css` |
| g-3 | class | `styles.css` |
| align-items-center | class | `styles.css` |
| justify-content-between | class | `styles.css` |
| py-3 | class | `styles.css` |
| card-header | class | `styles.css` |
| col-lg-4 | class | `styles.css` |
| pt-4 | class | `styles.css` |
| text-sm | class | `styles.css` |
| p-3 | class | `styles.css` |
| col-xl-4 | class | `styles.css` |
| mt-5 | class | `styles.css` |
| pb-5 | class | `styles.css` |
| shadow-sm | class | `styles.css` |
| me-2 | class | `styles.css` |
| text-muted | class | `styles.css` |
| text-white | class | `styles.css` |
| col-12 | class | `styles.css` |
| d-none | class | `styles.css` |
| col-md-12 | class | `styles.css` |
| d-block | class | `styles.css` |
| container-fluid | class | `styles.css` |
| row-cols-1 | class | `styles.css` |
| container | class | `styles.css` |
| col-lg-3 | class | `styles.css` |
| row-cols-md-3 | class | `styles.css` |
| col-lg-2 | class | `styles.css` |
| me-3 | class | `styles.css` |
| py-2 | class | `styles.css` |
| pt-3 | class | `styles.css` |
| mx-auto | class | `styles.css` |
| btn-custom | class | `styles.css` |

## CSS Variables Used

To make this CSS more robust and easier to maintain, we define several CSS variables for common colors and spacing.

```css
:root {
    /* Colors */
    --color-primary: #007bff; /* Blue */
    --color-secondary: #6c757d; /* Grey */
    --color-success: #28a745; /* Green */
    --color-danger: #dc3545; /* Red */
    --color-warning: #ffc107; /* Yellow */
    --color-info: #17a2b8; /* Cyan/Teal */

    /* Text & Background */
    --color-text-base: #333;
    --color-text-muted: #6c757d;
    --color-text-white: #fff;
    --color-background: #f8f9fa;
    --color-card-bg: #fff;

    /* Borders & Dividers */
    --color-border: #dee2e6;
    --color-shadow: rgba(0, 0, 0, 0.1);

    /* Spacing & Sizing (Using rem/px for general control) */
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 3rem;
}
```

## Core Component Styling (Utility Classes)

These classes implement common layout, typography, and component styling patterns.

```css
/* =========================================
   1. LAYOUT & GRID SYSTEM (Based on Bootstrap principles)
   ========================================= */

/* Container sizing */
.container {
    width: 100%;
    padding-right: var(--spacing-md);
    padding-left: var(--spacing-md);
    margin-right: auto;
    margin-left: auto;
}

/* Row setup (Flex container) */
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: calc(-1 * var(--spacing-md) * 2); /* Compensate for column gutters */
    margin-left: calc(-1 * var(--spacing-md) * 2);
}

/* Column definitions */
[class*="col-"] {
    padding-right: var(--spacing-md);
    padding-left: var(--spacing-md);
}

/* Responsive column sizing (Example for col-md-6) */
.col-md-6 {
    flex: 0 0 auto;
    padding-right: var(--spacing-md);
    padding-left: var(--spacing-md);
    /* Simplified implementation for demonstration */
    flex-basis: calc(50% - 2 * var(--spacing-md));
}
/* To keep it simple, we rely on the utility classes provided in the list above 
   to structure the layout logic using margin/padding helpers. */


/* =========================================
   2. SPACING UTILITIES (Margin & Padding)
   ========================================= */
.pt-3 { padding-top: var(--spacing-md); }
.pt-4 { padding-top: var(--spacing-lg); }
.pb-5 { padding-bottom: var(--spacing-xl); }
.pb-5 { padding-bottom: var(--spacing-xl); }
.py-2 { padding-top: var(--spacing-md); padding-bottom: var(--spacing-md); }
.py-3 { padding-top: var(--spacing-md); padding-bottom: var(--spacing-md); }
.p-3 { padding: var(--spacing-md); }
.p-4 { padding: var(--spacing-lg); }
.p-md-0 { padding-right: 0; padding-left: 0; }

.mt-4 { margin-top: var(--spacing-lg); }
.mt-5 { margin-top: var(--spacing-xl); }
.me-2 { margin-right: var(--spacing-md); }
.me-3 { margin-right: calc(var(--spacing-md) * 1.5); }

/* =========================================
   3. TYPOGRAPHY & COLORS
   ========================================= */
.text-center { text-align: center; }
.text-muted { color: var(--color-text-muted); }
.text-white { color: var(--color-text-white); }

/* =========================================
   4. COMPONENTS
   ========================================= */

/* Cards */
.card-wrapper {
    border: 1px solid var(--color-border);
    border-radius: var(--spacing-sm);
    box-shadow: 0 0.125rem 0.25rem var(--color-shadow);
    transition: box-shadow 0.2s ease-in-out;
}
.card-wrapper:hover {
    box-shadow: 0 0.25rem 0.5rem var(--color-shadow);
}
.card-header {
    padding: var(--spacing-md);
    border-bottom: 1px solid var(--color-border);
    background-color: var(--color-card-bg);
}

/* Forms */
.form-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    box-sizing: border-box;
}

/* Buttons */
/* General button styling for primary actions */
.btn-primary {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 0.375rem 1.5rem;
    border-radius: 0.25rem;
    cursor: pointer;
}

/* Utility for displaying simple text/sections */
.section-title {
    margin-bottom: 1rem;
    font-size: 1.25rem;
    font-weight: 600;
}
```
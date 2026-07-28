We need to produce improved markdown, preserving everything, just rephrase text, add description per "File Structure Purpose" column with dash, add description below each module (Module: css) 1-2 sentences. Also edit tables: add purpose to column File? Actually instructions: "En la tabla File Structure, agrega una descripción corta (10-15 palabras) a la columna Purpose existente, separada con un guion largo (—)". So we need to add purpose to File column? They say add description to the Purpose column? Actually they have column Purpose; we need to add description to that? The column likely missing description. Probably we need to add a short description (10-15 words) after the purpose value in that column, separated by a long dash ( — ), meaning we need to append something like " — defines global CSS for UI". That's maybe longer than 10-15 words? The instruction: add a description short (10-15 words) to the Purpose column existing, separated with a long dash. So each row: original Purpose "CSS styles". We replace with "CSS styles — defines global UI styling". That's about 7 words plus dash. Might be okay.

Also: "En la tabla Exports, elimina filas con nombre "undefined" y filas duplicados exactas (mismo nombre + mismo kind + mismo archivo)". In original table, there is no undefined. But there may be duplicates? Look: many rows like name same but different kind? duplicates? All combos unique.

Also for files empty (Pendiente de implementar) write "Archivo sin implementar — pendiente de definir responsabilidad". But there are none.

Also "No inventes módulos...", "Preserves entire technical info". So keep as is.

Need to add description below each module: "Module: css\n\nCSS files contain all style rules for the application." maybe.

But original markdown: "# Module: css\n\n## File Structure\n\n| File | Purpose |\n|---\n| `styles.css` | CSS styles |"

We need to preserve headings format. So add description sentence below "Module: css". So after "# Module: css" add blank line then sentence: "This module contains the CSS files for styling the component." but must preserve Spanish? original is Spanish? "Module: css". The description should be 1-2 sentences English? The original is Spanish? Actually original text is Spanish. But instruction: "NO traduzca contenido. Si el markdown original está en español, mantenlo en español." So we keep Spanish. So add sentence "Este módulo contiene los archivos CSS para el estilo del componente." 1 sentence.

Now file description per file? We need to fill Purpose column with description (10-15 words). The current Purpose is "CSS styles". That's incomplete, maybe replace to "CSS styles — defines global UI styling". That's good.

Also maybe need to add description to each purpose? The instruction: "agrega una descripción corta (10-15 palabras) a la columna Purpose existente". So replace Purpose with description plus dash plus original? Or maybe keep "CSS styles" then dash + description. We'll do "CSS styles — defines global UI styling". That's 7 words plus "defines global UI styling". Total maybe ~10.

Now after module description, we should keep Table.

Exports table: preserve as is, no further changes.

CSS Variables table: preserve.

Make sure no bold or headers in tables.

Now produce final markdown.

Let's draft:

# Module: css
Este módulo contiene los archivos CSS para el estilo del componente.

## File Structure
| File | Purpose |
|---|---|
| `styles.css` | CSS styles — defines global UI styling |

## Exports
... same table.

## CSS Variables
...

But need to preserve original tables exactly. They have pipe separators: | File | Purpose | with header. Should copy.

Also need to keep "## Exports" heading but keep table.

Now for Exports table, ensure no undefined rows.

Now produce final.
</think>
# Module: css
Este módulo contiene los archivos CSS para el estilo del componente.

## File Structure
| File | Purpose |
|---|---|
| `styles.css` | CSS styles — defines global UI styling |

## Exports
| Name | Kind | File |
|--|--|--|
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
| area-img-wrapper | class | `styles.css` |
| trainer-info | class | `styles.css` |
| membresia-card | class | `styles.css` |
| popular | class | `styles.css` |
| membresia-badge | class | `styles.css` |
| membresia-header | class | `styles.css` |
| precio | class | `styles.css` |
| membresia-features | class | `styles.css` |
| modal-overlay | class | `styles.css` |
| active | class | `styles.css` |
| modal-content | class | `styles.css` |
| close-modal | class | `styles.css` |
| input-row | class | `styles.css` |
| input-group | class | `styles.css` |
| error-message | class | `styles.css` |
| form-link | class | `styles.css` |
| schedule-table-container | class | `styles.css` |
| schedule-table | class | `styles.css` |
| time | class | `styles.css` |
| footer | class | `styles.css` |
| footer-main | class | `styles.css` |
| footer-icon | class | `styles.css` |
| social-links | class | `styles.css` |
| social-btn | class | `styles.css` |
| footer-bottom | class | `styles.css` |
| footer-brand | class | `styles.css` |
| mobile-menu | class | `styles.css` |
| mobile-user-name | class | `styles.css` |
| mobile-group-header | class | `styles.css` |
| btn-mobile | class | `styles.css` |
| fade-up | class | `styles.css` |
| visible | class | `styles.css` |
| fade-up-delay-1 | class | `styles.css` |
| fade-up-delay-2 | class | `styles.css` |
| fade-up-delay-3 | class | `styles.css` |
| fade-up-delay-4 | class | `styles.css` |
| inscripcion-modal | class | `styles.css` |
| wizard-progress | class | `styles.css` |
| wizard-step-indicator | class | `styles.css` |
| step-circle | class | `styles.css` |
| wizard-line | class | `styles.css` |
| planes-grid | class | `styles.css` |
| plan-card | class | `styles.css` |
| selected | class | `styles.css` |
| plan-icon | class | `styles.css` |
| plan-precio | class | `styles.css` |
| plan-periodo | class | `styles.css` |
| plan-error | class | `styles.css` |
| entrenadores-grid | class | `styles.css` |
| entrenador-card | class | `styles.css` |
| entrenador-avatar | class | `styles.css` |
| entrenador-info | class | `styles.css` |
| ent-esp | class | `styles.css` |
| ent-check | class | `styles.css` |
| skip-trainer | class | `styles.css` |
| btn-skip | class | `styles.css` |
| confirm-icon | class | `styles.css` |
| confirm-summary | class | `styles.css` |
| summary-row | class | `styles.css` |
| summary-label | class | `styles.css` |
| summary-value | class | `styles.css` |
| summary-precio | class | `styles.css` |
| confirm-actions | class | `styles.css` |
| success-icon | class | `styles.css` |
| wizard-nav | class | `styles.css` |
| btn-outline-wizard | class | `styles.css` |
| modalFadeIn | class | `styles.css` |
| popIn | class | `styles.css` |

## CSS Variables
| Variable | File |
|---|---|
| --primary-color | `styles.css` |
| --bg-main | `styles.css` |
| --accent-color | `styles.css` |
| --text-main | `styles.css` |
| --bg-light | `styles.css` |
| --card-bg | `styles.css` |
| --text-muted | `styles.css` |
| --border-color | `styles.css` |
| --shadow | `styles.css` |
| --shadow-hover | `styles.css` |
| --shadow-hover-accent | `styles.css` |
| --transition | `styles.css` |
|
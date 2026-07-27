# Proyecto_Gimnasio

## Overview

| Technology |
|------------|
| CSS        |
| SQL        |
| PHP        |
| JavaScript |

## Project Structure

```
Proyecto_Gimnasio/
├── README.md
├── css/
│   └── styles.css
├── database/
│   ├── schema.sql
│   └── migrations/
├── php/
│   └── app.php
└── index.php
```

## Modules

| Module      | Files |
|-------------|-------|
| [css](docs/css.md) | 1 |
| [database](docs/database.md) | 4 |
| [js](docs/js.md) | 1 |
| [php](docs/php.md) | 8 |

This module handles the visual styling of the application using CSS files.  
This module manages the database schema and migrations for the application.  
This module handles client-side JavaScript functionality for interactive elements.  
This module contains the core PHP logic for server-side processing and business rules.

## Database Schema

| Table       | Columns      |
|-------------|--------------|
| users       | id, name, email |
| products    | id, name, price |
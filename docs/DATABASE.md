# Base de datos

## Estado actual

El repositorio contiene migraciones de Laravel y de funcionalidades recientes, pero gran parte de las tablas operativas (`ot`, stock, sucursales, clientes y otras) provienen de un esquema legacy y todavía no están representadas completamente como migraciones.

Por ese motivo:

- `php artisan migrate` puede usarse para cambios incrementales controlados.
- `php artisan migrate:fresh` **no debe usarse en producción**.
- Crear un entorno totalmente vacío requiere actualmente disponer del esquema base legacy.

## Corrección aplicada

Existían dos migraciones `create_permission_tables` que intentaban crear las mismas tablas de Spatie Permission. Se conserva la migración de 2023 y se elimina la duplicada de 2024 para evitar colisiones en instalaciones limpias de ese componente.

## Camino para lograr reproducibilidad total

1. Obtener un esquema estructural sanitizado de la base actual, sin datos productivos.
2. Versionar un `schema dump` o migraciones baseline para las tablas legacy.
3. Agregar seeders mínimos para catálogos necesarios en tests.
4. Configurar SQLite/MySQL de testing según compatibilidad de consultas.
5. Incorporar un job CI separado que ejecute reconstrucción desde cero.

Esta tarea debe realizarse contra una copia de estructura real; inferir tipos, índices y claves foráneas únicamente desde modelos podría introducir pérdida de información o incompatibilidades.

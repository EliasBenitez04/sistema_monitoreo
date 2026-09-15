# Despliegue

## Requisitos recomendados

- Linux.
- PHP 8.1 con extensiones requeridas por Laravel y MySQL.
- Composer 2.
- Node.js 18 para compilar assets.
- MySQL.
- Nginx o Apache apuntando a `public/`.

## Procedimiento

Antes de desplegar:

1. Realizar backup de base de datos.
2. Confirmar que CI está en verde.
3. Verificar variables de entorno y permisos de storage/cache.

Ejemplo de actualización:

```bash
git pull --ff-only
composer install --no-dev --optimize-autoloader --no-interaction
npm ci
npm run production
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan queue:restart
```

Si el servidor no compila assets, genere `public/css` y `public/js` en el pipeline de release y despliegue esos artefactos.

## Variables de producción

```dotenv
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=warning
```

No utilice `migrate:fresh` contra una base con información real.

## Rollback

El rollback de aplicación debe realizarse a un commit/tag conocido. Para cambios de esquema, prepare explícitamente el plan de reversión y backup antes del despliegue; no asuma que todas las migraciones legacy son reversibles sin pérdida.

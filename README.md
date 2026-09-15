# Sistema Monitoreo

Sistema interno desarrollado con Laravel para centralizar seguimiento operativo, órdenes de trabajo, logística, stock, compras, auditoría y redistribución de mercadería entre sucursales.

## Módulos principales

- Órdenes de trabajo (OT), trazabilidad e historia general.
- Dashboards operativos y control de OT atrasadas.
- Logística e importación/exportación de información.
- Stock y ventas por sucursal.
- Redistribución sugerida, aprobación, lotes, remisiones y exportación PDF/Excel.
- Pedidos de compra.
- Clientes, artículos, sucursales, ciudades y departamentos.
- Usuarios, roles y permisos con Spatie Laravel Permission.
- Auditoría y registro de accesos.
- Procesamiento de imágenes para prendas.

## Stack

- PHP 8.0.2+ (PHP 8.1 recomendado para desarrollo/CI).
- Laravel 9.
- MySQL.
- Laravel Sanctum.
- Spatie Laravel Permission.
- AdminLTE 3 / Bootstrap 4 / jQuery.
- Laravel Mix 6.
- Maatwebsite Excel, DomPDF y PHPWord.

## Instalación para desarrollo

```bash
git clone https://github.com/EliasBenitez04/sistema_monitoreo.git
cd sistema_monitoreo
composer install
npm ci
cp .env.example .env
php artisan key:generate
```

Configure la conexión MySQL en `.env` y luego compile los assets:

```bash
npm run development
```

Para una compilación de producción:

```bash
npm run production
```

### Base de datos

El sistema nació sobre un esquema operativo existente. Actualmente el repositorio **no contiene todavía una migración base completa de todas las tablas legacy**, por lo que no debe asumirse que `php artisan migrate:fresh` reconstruirá por sí solo una instalación completa.

Las migraciones versionadas sí deben poder ejecutarse de forma incremental sobre el esquema base. Se eliminó una migración duplicada de Spatie Permission que podía romper instalaciones limpias de esa parte del esquema.

Consulte `docs/DATABASE.md` antes de crear un entorno desde cero.

## Calidad y pruebas

```bash
composer test
composer test:unit
composer test:feature
```

El CI de GitHub ejecuta instalación de dependencias, pruebas PHPUnit y compilación de frontend en cada Pull Request y push a las ramas configuradas.

## Arquitectura

La dirección arquitectónica es:

```text
Route
  -> Controller pequeño
      -> FormRequest
      -> Service / Action
          -> Eloquent / Query Builder
```

La lógica de redistribución se está separando del controlador legacy en una capa de servicios testeable. Las rutas refactorizadas se cargan después de `routes/web.php` para reemplazar de forma controlada acciones puntuales sin modificar de golpe el comportamiento restante.

Más detalles en `docs/ARCHITECTURE.md`.

## Seguridad

- Las áreas operativas utilizan autenticación.
- Los módulos sensibles utilizan permisos de Spatie.
- No se deben versionar `.env`, credenciales, dumps con datos reales ni claves privadas.
- En producción use `APP_ENV=production` y `APP_DEBUG=false`.

Consulte `SECURITY.md`.

## Despliegue

Consulte `docs/DEPLOYMENT.md`. Antes de cualquier despliegue con cambios de esquema, realice backup de base de datos y ejecute únicamente migraciones incrementales con `php artisan migrate --force`.

## Flujo de contribución

1. Crear una rama desde `master`.
2. Implementar el cambio con pruebas cuando corresponda.
3. Ejecutar `composer test` y `npm run production`.
4. Abrir Pull Request.
5. Fusionar solamente con CI en verde.

Consulte `CONTRIBUTING.md`.

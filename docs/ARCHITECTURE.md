# Arquitectura

## Objetivo

Reducir progresivamente la concentración de lógica en controladores y vistas legacy sin introducir una reescritura de alto riesgo.

## Capas objetivo

```text
HTTP Route
  -> Controller / Invokable Controller
      -> FormRequest
      -> Service / Action
          -> Models / Query Builder
              -> Database
```

Los controladores deben coordinar HTTP: autorización, entrada, respuesta y mensajes. Las reglas de negocio deben vivir en servicios testeables.

## Estrategia de migración incremental

`routes/web.php` contiene el sistema legacy. `routes/refactored.php` se carga después y reemplaza únicamente rutas concretas ya migradas. Esto permite aplicar el patrón Strangler Fig: mover una operación a la vez y conservar el resto del módulo estable.

### Redistribución

La acción `RedistribucionSugeridas.analizar` quedó separada en:

- `AnalizarRedistribucionRequest`: validación HTTP.
- `AnalizarRedistribucionController`: respuesta HTTP y logging.
- `RedistribucionAnalyzer`: transacción, consultas y persistencia.
- `RedistribucionPlanner`: algoritmo puro de cálculo, sin acceso a BD.
- `config/redistribucion.php`: prioridades y parámetros de negocio.

El algoritmo puro ya puede probarse sin MySQL.

### OT

La acción `ots.store` quedó separada en:

- `StoreTrazabilidadRequest`.
- `StoreTrazabilidadController`.
- `OtTrazabilidadService`.

## Próximas extracciones recomendadas

Migrar en este orden:

1. Generación y procesamiento de lotes de redistribución.
2. Finalización e importación de remisiones.
3. Importaciones OT/logística.
4. Dashboards OT y consultas agregadas.
5. Exportaciones PDF/Excel.

Cada migración debe conservar el mismo nombre de ruta y contrato de entrada/salida antes de eliminar el método legacy.

## Frontend

Las vistas Blade de gran tamaño deben separarse gradualmente en:

- componentes Blade para tablas, filtros, badges, modales y acciones;
- archivos JavaScript por módulo en `resources/js`;
- CSS de módulo fuera de `<style>` inline;
- parciales exclusivamente presentacionales.

No se recomienda reescribir simultáneamente backend y frontend de un módulo crítico.

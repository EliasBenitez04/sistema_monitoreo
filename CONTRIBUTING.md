# Contribuir al Sistema Monitoreo

## Flujo

1. Actualizar `master`.
2. Crear una rama descriptiva (`feature/...`, `fix/...`, `refactor/...`).
3. Mantener los cambios enfocados.
4. Agregar o actualizar pruebas.
5. Ejecutar:

```bash
composer test
npm run production
```

6. Abrir Pull Request con resumen, riesgo y pasos de prueba.

## Convenciones PHP

- Clases y archivos PSR-4 en PascalCase.
- Controladores HTTP pequeños.
- Validación en Form Requests.
- Lógica de negocio en Services/Actions.
- Evitar nuevas consultas complejas dentro de Blade.
- Usar transacciones para operaciones multi-escritura.

## Compatibilidad

En refactors de módulos legacy, conservar rutas, nombres de ruta y contratos de formularios salvo que el cambio funcional esté documentado explícitamente.

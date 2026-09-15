# Seguridad

## Controles existentes

El sistema utiliza autenticación de Laravel y permisos mediante Spatie Laravel Permission en módulos sensibles.

## Reglas para el repositorio

- Nunca versionar `.env`, contraseñas, tokens, claves privadas ni dumps con datos reales.
- Mantener `APP_DEBUG=false` en producción.
- Registrar errores técnicos en logs y mostrar mensajes genéricos al usuario.
- Validar toda entrada mediante Form Requests o validadores equivalentes.
- Proteger operaciones de escritura con autorización además de ocultar botones en la UI.
- Validar tipo, extensión, tamaño y destino de archivos subidos.
- Revisar periódicamente dependencias PHP y npm.

## Reporte de vulnerabilidades

No publicar credenciales ni datos sensibles en Issues públicos. Utilizar un canal privado del responsable del sistema para reportes de seguridad.

## Hardening recomendado

- HTTPS obligatorio.
- Cookies `secure` y `http_only` en producción.
- Rate limiting en endpoints expuestos.
- Usuario MySQL con privilegios mínimos.
- Backups cifrados y probados.
- Monitoreo de logs y errores 5xx.

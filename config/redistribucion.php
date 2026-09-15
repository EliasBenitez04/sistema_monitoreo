<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Prioridad de sucursales
    |--------------------------------------------------------------------------
    */
    'origenes' => [22, 6, 3, 4, 7, 5],
    'destinos' => [9, 8, 14, 16, 2, 15],

    /*
    |--------------------------------------------------------------------------
    | Reglas de stock
    |--------------------------------------------------------------------------
    | El origen conserva 5% de sus ventas y el destino intenta alcanzar 200%.
    | Estos valores preservan la lógica existente, pero ahora están centralizados.
    */
    'porcentaje_stock_origen' => 0.05,
    'multiplicador_stock_destino' => 2.00,

    /*
    |--------------------------------------------------------------------------
    | Bloqueo de códigos
    |--------------------------------------------------------------------------
    | La implementación legacy calculaba códigos bloqueados pero no los aplicaba.
    | Se mantiene ese comportamiento por defecto y se deja la regla preparada para
    | activarse mediante configuración después de validación funcional.
    */
    'bloquear_codigos_activos' => env('REDISTRIBUCION_BLOQUEAR_CODIGOS_ACTIVOS', false),
    'dias_bloqueo_finalizados' => (int) env('REDISTRIBUCION_DIAS_BLOQUEO_FINALIZADOS', 30),

    'chunk_insert' => 1000,
];

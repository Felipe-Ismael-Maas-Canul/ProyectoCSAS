<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | Aquí puedes configurar las políticas de CORS para tu aplicación. Estas
    | políticas determinan cuáles solicitudes de origen cruzado están permitidas.
    |
    */

    // Rutas de la API que permitirán solicitudes CORS
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Métodos HTTP permitidos
    'allowed_methods' => ['*'],

    // Orígenes permitidos (Asegúrate de cambiar esto al dominio del frontend en producción)
    'allowed_origins' => ['http://localhost:4200'],

    // Encabezados permitidos
    'allowed_headers' => ['*'],

    // Encabezados que se expondrán al cliente
    'exposed_headers' => ['Authorization'],

    // Tiempo máximo para la validez de las políticas
    'max_age' => 0,

    // Permitir credenciales (Cambiar a true si necesitas cookies o autenticación basada en sesiones)
    'supports_credentials' => false,
];


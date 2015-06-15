<?php
$config = new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => '123456',
        'dbname'      => 'phalcon',
        'charset'     => 'utf8',
    ],
    'application' => [
        'controllersDir' => DIR_CONTROLLERS,
        'configDir'      => DIR_CONFIG,
        'modelsDir'      => DIR_MODELS,
        'migrationsDir'  => DIR_MIGRATIONS,
        'viewsDir'       => DIR_VIEWS,
        'pluginsDir'     => DIR_PLUGINS,
        'libraryDir'     => DIR_LIBRARY,
        'cacheDir'       => DIR_CACHE,
        'baseUri'        => '/',
    ]
]);

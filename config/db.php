<?php

return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'mysql:host=localhost;port=8889;dbname=bjr',
    'dsn' => 'pgsql:host=localhost;port=5432;dbname=bjr',
    'username' => 'developer',
    'password' => 'perlina1111',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

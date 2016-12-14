<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=200.87.228.58;dbname=db_grupo05sa',
    'username' => 'grupo05sa',
    'password' => 'grupo05grupo05',
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql' => [
            'class' => 'yii\db\pgsql\Schema',
            'defaultSchema' => 'public' //specify your schema here
        ]
    ], // PostgreSQL
];
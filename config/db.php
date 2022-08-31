<?php

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}


return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] .';dbname=' . $_ENV['DB_DATABASE'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'utf8',
    
    // 'dsn' => 'pgsql:host=ec2-35-168-122-84.compute-1.amazonaws.com;port=5432;dbname=dapv3p5h1u83pi',
    // 'username' => 'syqzradatresbu',
    // 'password' => 'a043552879e821180b9382440db4d38eca9c6b77a08bb8e3f3e1ec0a85d095bc',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

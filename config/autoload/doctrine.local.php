<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'password' => 'cawa123azs',
                    'dbname' => 'zf2-blog',
                    'driverOptions' => array(
                        1002 => 'SET NAMES utf8',
                    ),
                )
            )
        ),
        'configuration' => array(
            'orm_default' => array(
                'proxy_dir' => 'data/DoctrineORMModule/Proxy',
                'proxy_namespace' => 'DoctrineORMModule\Proxy',
            )    
        )
    )
);

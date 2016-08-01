<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'zfcuser_user_mapper'    => 'ZfcUserDoctrineORM\Factory\UserMapperFactory',
            'zfcuser_module_options' => 'ZfcUserDoctrineORM\Factory\ModuleOptionsFactory',
        ),
        'aliases'   => array(
            'zfcuser_register_form_hydrator' => 'zfcuser_user_hydrator',
            'zfcuser_zend_db_adapter'        => 'Zend\Db\Adapter\Adapter',
            'zfcuser_doctrine_em'            => 'Doctrine\ORM\EntityManager',
        ),
    ),
    'doctrine'        => array(
        'driver' => array(
            'zfcuser_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/xml/zfcuser',
            ),

            'orm_default' => array(
                'drivers' => array(
                    'ZfcUser\Entity' => 'zfcuser_entity',
                ),
            ),
        ),
    ),
);

<?php

$userModelClass = 'ZfcUserDoctrineORM\Entity\User';

return array(
    'zfcuser' => array(
        'user_model_class'          => $userModelClass,
        'usermeta_model_class'      => 'ZfcUserDoctrineORM\Entity\UserMeta',
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'zfcuser_doctrine_em'     => 'Doctrine\ORM\EntityManager',
                'zfcuser_user_mapper'     => 'ZfcUserDoctrineORM\Mapper\User',
                'zfcuser_usermeta_mapper' => 'ZfcUserDoctrineORM\Mapper\UserMeta',
                'zfcuser_user_repository' => array(
                    'Doctrine\ORM\EntityManager',
                    'getRepository' => array(
                        'repository' => $userModelClass
                    )
                )
            ),
            'orm_driver_chain' => array(
                'parameters' => array(
                    'drivers' => array(
                        'zfcuser_xml_driver' => array(
                            'class'          => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                            'namespace'      => 'ZfcUserDoctrineORM\Entity',
                            'paths'          => array(__DIR__ . '/xml'),
                            'file_extension' => '.orm.xml',
                        ),
                    ),
                )
            ),
        ),
    ),
);

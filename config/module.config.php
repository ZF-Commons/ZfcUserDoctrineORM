<?php
return array(
    'zfcuser' => array(
        'user_model_class'          => 'ZfcUserDoctrineORM\Entity\User',
        'usermeta_model_class'      => 'ZfcUserDoctrineORM\Entity\UserMeta',
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'zfcuser_doctrine_em'     => 'doctrine_em',
                'zfcuser_user_mapper'     => 'ZfcUserDoctrineORM\Mapper\UserDoctrine',
                'zfcuser_usermeta_mapper' => 'ZfcUserDoctrineORM\Mapper\UserMetaDoctrine',
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
            'ZfcUserDoctrineORM\Mapper\UserDoctrine' => array(
                'parameters' => array(
                    'em' => 'zfcuser_doctrine_em',
                ),
            ),
            'ZfcUserDoctrineORM\Mapper\UserMetaDoctrine' => array(
                'parameters' => array(
                    'em' => 'zfcuser_doctrine_em',
                ),
            ),
        ),
    ),
);

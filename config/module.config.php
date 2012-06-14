<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'zfcuser_model' => array(
                'type'  => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/xml/model'
            ),

            'orm_default' => array(
                'drivers' => array(
                    'ZfcUser\Model'  => 'zfcuser_model'
                )
            )
        )
    ),

    'zfcuser' => array(
        'enable_default_entities' => true,

        'user_model_class'        => 'ZfcUserDoctrineORM\Entity\User',
        'usermeta_model_class'    => 'ZfcUserDoctrineORM\Entity\UserMeta',
    )
);

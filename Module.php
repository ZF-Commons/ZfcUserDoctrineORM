<?php

namespace ZfcUserDoctrineORM;

use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Zend\EventManager\StaticEventManager;
use ZfcUserDoctrineORM\Event\ResolveTargetEntityListener;
use ZfcUser\Module as ZfcUser;

class Module
{
    public function init($mm)
    {
        // Load Doctrine mapping information from XML.
        $sharedEvents = $mm->events()->getSharedManager();
        $sharedEvents->attach('DoctrineORMModule', 'loadDrivers', function($e) {
            $chain = $e->getTarget();

            if (ZfcUser::getOption('load_default_entities')) {
                $chain->addDriver(new XmlDriver(__DIR__ . '/config/xml/entity'), 'ZfcUserDoctrineORM\Entity');
            }

            $chain->addDriver(new XmlDriver(__DIR__ . '/config/xml/model'), 'ZfcUser\Model');
        });
    }

    public function onBootstrap($e)
    {
        $app = $e->getParam('application');
        $sm  = $app->getServiceManager();
        $em  = $sm->get('zfcuser_doctrine_em');
        $evm = $em->getEventManager();

        $listener = new ResolveTargetEntityListener;
        $listener->addResolveTargetEntity(
            'ZfcUser\Model\UserInterface',
            ZfcUser::getOption('user_model_class'),
            array()
        );
        $evm->addEventListener(\Doctrine\ORM\Events::loadClassMetadata, $listener);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfiguration()
    {
        return array(
            'aliases' => array(
                'zfcuser_doctrine_em' => 'doctrine.entitymanager.orm_default',

            ),
            'factories' => array(
                'zfcuser_user_repository' => function ($sm) {
                    $mapper = $sm->get('zfcuser_user_mapper');
                    return new Repository\User($mapper);
                },

                'zfcuser_user_mapper' => function ($sm) {
                    return new \ZfcUserDoctrineORM\Mapper\User(
                        $sm->get('zfcuser_doctrine_em')
                    );
                },
                'zfcuser_usermeta_mapper' => function ($sm) {
                    return new \ZfcUserDoctrineORM\Mapper\UserMeta(
                        $sm->get('zfcuser_doctrine_em')
                    );
                },
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}

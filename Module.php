<?php

namespace ZfcUserDoctrineORM;

use Zend\ModuleManager\ModuleManager,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    ZfcUserDoctrineORM\Event\ResolveTargetEntityListener,
    ZfcUser\Module as ZfcUser,
    Doctrine\ORM\Events,
    Zend\EventManager\StaticEventManager,
    Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements
    AutoloaderProviderInterface,
    ServiceProviderInterface
{
    public function init(ModuleManager $moduleManager)
    {
        $events = StaticEventManager::getInstance();
        $events->attach('bootstrap', 'bootstrap', array($this, 'attachDoctrineEvents'), 100);
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
            'factories' => array(
                'zfcuser_user_mapper' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $class = ZfcUser::getOption('user_model_class');
                    return new \ZfcBase\Mapper\DoctrineMapperProxy($em, $class);
                },
                'zfcuser_usermeta_mapper' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $class = ZfcUser::getOption('usermeta_model_class');
                    return new \ZfcUserDoctrineORM\Mapper\UserMeta($em, $class);
                },
                'zfcuser_user_repository' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $class = ZfcUser::getOption('user_model_class');
                    $doctrineRepository = $em->getRepository($class);
                    $repository = new \ZfcUserDoctrineORM\Repository\User($em, $doctrineRepository);
                    return $repository;
                }
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function attachDoctrineEvents($e)
    {
        $app = $e->getParam('application');
        $locator = $app->getLocator();
        $em = $locator->get('zfcuser_doctrine_em');
        $evm = $em->getEventManager();
        $listener = new ResolveTargetEntityListener;
        $listener->addResolveTargetEntity(
            'ZfcUser\Model\UserInterface',
            ZfcUser::getOption('user_model_class'),
            array()
        );
        $evm->addEventListener(Events::loadClassMetadata, $listener);
    }
}

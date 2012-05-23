<?php

namespace ZfcUserDoctrineORM;

use Zend\ModuleManager\ModuleManager,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    ZfcUserDoctrineORM\Event\ResolveTargetEntityListener,
    ZfcUser\Module as ZfcUser,
    Doctrine\ORM\Events,
    Zend\EventManager\StaticEventManager;

class Module implements AutoloaderProviderInterface
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
                    $di = $sm->get('Di');
                    $em = $di->get('Doctrine\ORM\EntityManager');
                    return new \ZfcUserDoctrineORM\Mapper\UserDoctrine($em);
                },
                'zfcuser_usermeta_mapper' => function ($sm) {
                    $di = $sm->get('Di');
                    $em = $di->get('Doctrine\ORM\EntityManager');
                    return new \ZfcUserDoctrineORM\Mapper\UserMetaDoctrine($em);
                },
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

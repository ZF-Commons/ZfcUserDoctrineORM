<?php

namespace ZfcUserDoctrineORM;

use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature;
use Zend\ServiceManager\ServiceManager;
use ZfcUserDoctrineORM\Factory;
use ZfcUserDoctrineORM\Mapper;
use ZfcUserDoctrineORM\Options;
use Doctrine\ORM\EntityManager;


class Module
    implements Feature\AutoloaderProviderInterface, Feature\BootstrapListenerInterface, Feature\ServiceProviderInterface
{
    public function onBootstrap(EventInterface $e)
    {
        $app = $e->getParam('application');
        /** @var ServiceManager $sm */
        $sm = $app->getServiceManager();

        /** @var Options\ModuleOptions $options */
        $options = $sm->get('zfcuser_module_options');

        // Add the default entity driver only if specified in configuration
        if ($options->getEnableDefaultEntities()) {
            $chain = $sm->get('doctrine.driver.orm_default');
            $chain->addDriver(new XmlDriver(__DIR__ . '/config/xml/zfcuserdoctrineorm'), 'ZfcUserDoctrineORM\Entity');
        }
    }

    /**
     * @return array
     */
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

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'aliases'   => array(
                'zfcuser_user_mapper'    => Mapper\User::class,
                'zfcuser_module_options' => Options\ModuleOptions::class,
                'zfcuser_doctrine_em'    => EntityManager::class,
            ),
            'factories' => array(
                Mapper\User::class           => Factory\UserMapperFactory::class,
                Options\ModuleOptions::class => Factory\ModuleOptionsFactory::class,
            ),
        );
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}

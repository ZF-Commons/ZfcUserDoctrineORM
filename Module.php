<?php

namespace ZfcUserDoctrineORM;

use Doctrine\ORM\Mapping\Driver\XmlDriver;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature;
use Zend\ServiceManager\ServiceManager;
use ZfcUserDoctrineORM\Options\ModuleOptions;


class Module implements Feature\AutoloaderProviderInterface, Feature\BootstrapListenerInterface
{
    public function onBootstrap(EventInterface $e)
    {
        $app = $e->getParam('application');
        /** @var ServiceManager $sm */
        $sm = $app->getServiceManager();

        /** @var ModuleOptions $options */
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

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}

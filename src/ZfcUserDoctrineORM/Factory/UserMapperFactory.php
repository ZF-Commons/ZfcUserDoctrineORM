<?php
namespace ZfcUserDoctrineORM\Factory;

use Zend\Db;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator;
use ZfcUser\Mapper;
use ZfcUser\Options;

class UserMapperFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new \ZfcUserDoctrineORM\Mapper\User(
            $serviceLocator->get('zfcuser_doctrine_em'),
            $serviceLocator->get('zfcuser_module_options')
        );
    }
}

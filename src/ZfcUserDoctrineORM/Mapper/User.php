<?php

namespace ZfcUserDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager;
use ZfcUser\Mapper\User as ZfcUserMapper;
use ZfcUserDoctrineORM\Options\ModuleOptions;
use Zend\Stdlib\Hydrator\HydratorInterface;

class User extends ZfcUserMapper
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \ZfcUserDoctrineORM\Options\ModuleOptions
     */
    protected $options;

    public function __construct(EntityManager $em, ModuleOptions $options)
    {
        $this->em      = $em;
        $this->options = $options;
    }

    public function findByEmail($email)
    {
        $er = $this->em->getRepository($this->options->getUserEntityClass());

        return $er->findOneBy(array('email' => $email));
    }

    public function findByUsername($username)
    {
        $er = $this->em->getRepository($this->options->getUserEntityClass());

        return $er->findOneBy(array('username' => $username));
    }

    public function findById($id)
    {
        $er = $this->em->getRepository($this->options->getUserEntityClass());

        return $er->find($id);
    }

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        return $this->persist($entity);
    }

    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        return $this->persist($entity);
    }

    protected function persist($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}

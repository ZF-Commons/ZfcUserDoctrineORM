<?php

namespace ZfcUserDoctrineORM\Mapper;

use Doctrine\ORM\EntityManagerInterface;
use ZfcUser\Entity\UserInterface;
use ZfcUser\Mapper\User as ZfcUserMapper;
use ZfcUserDoctrineORM\Options\ModuleOptions;
use Zend\Stdlib\Hydrator\HydratorInterface;

class User extends ZfcUserMapper
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    protected $em;

    /**
     * @var \ZfcUserDoctrineORM\Options\ModuleOptions
     */
    protected $options;

    public function __construct(EntityManagerInterface $em, ModuleOptions $options)
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

    public function insert(UserInterface $entity)
    {
        return $this->persist($entity);
    }

    public function update(UserInterface $entity)
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

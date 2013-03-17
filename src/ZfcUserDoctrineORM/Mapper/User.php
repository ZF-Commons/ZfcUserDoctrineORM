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

    /**
     * @var array
     */
    protected $identityFields;

    public function __construct(EntityManager $em, ModuleOptions $options, array $identityFields)
    {
        $this->em      = $em;
        $this->options = $options;
        $this->identityFields = $identityFields;
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

    public function findByIdentity($identity)
    {
        $userObject = null;

        // Cycle through the configured identity sources and test each
        while ( !is_object($userObject) && count($this->identityFields) > 0 ) {
            $mode = array_shift($this->identityFields);
            switch ($mode) {
                case 'username':
                    $userObject = $this->findByUsername($identity);
                    break;
                case 'email':
                    $userObject = $this->findByEmail($identity);
                    break;
            }
        }

        return $userObject;
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
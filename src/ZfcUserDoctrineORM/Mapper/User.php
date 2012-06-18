<?php

namespace ZfcUserDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager;
use ZfcUser\Mapper\User as ZfcUserMapper;
use ZfcUser\Module as ZfcUser;

class User extends ZfcUserMapper
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function em()
    {
        return $this->em;
    }

    public function find($id)
    {
        $class = ZfcUser::getOption('user_model_class');
        return $this->em()->getRepository($class)->find($id);
    }

    public function persist($model)
    {
        $this->em()->persist($model);
        $this->em()->flush();
    }
}
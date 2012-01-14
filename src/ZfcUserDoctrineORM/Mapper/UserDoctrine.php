<?php

namespace ZfcUserDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager,
    ZfcUser\Module as ZfcUser,
    ZfcUser\Model\User,
    ZfcUser\Model\Mapper\User as UserMapper,
    ZfcBase\EventManager\EventProvider;

class UserDoctrine extends EventProvider implements UserMapper
{
    protected $em;

    public function persist(User $user)
    {
        $em = $this->getEntityManager();
        $this->events()->trigger(__FUNCTION__ . '.pre', $this, array('user' => $user, 'em' => $em));
        $em->persist($user);
        $this->events()->trigger(__FUNCTION__ . '.post', $this, array('user' => $user, 'em' => $em));
        $em->flush();
    }

    public function findByEmail($email)
    {
        $em = $this->getEntityManager();
        $user = $this->getUserRepository()->findOneBy(array('email' => $email));
        $this->events()->trigger(__FUNCTION__, $this, array('user' => $user, 'em' => $em));
        return $user;
    }

    public function findByUsername($username)
    {
        $em = $this->getEntityManager();
        $user = $this->getUserRepository()->findOneBy(array('username' => $username));
        $this->events()->trigger(__FUNCTION__, $this, array('user' => $user, 'em' => $em));
        return $user;
    }
    
    public function findById($id)
    {
        $em = $this->getEntityManager();
        $user = $this->getUserRepository()->find($id);
        $this->events()->trigger(__FUNCTION__, $this, array('user' => $user, 'em' => $em));
        return $user;
    }

    public function getEntityManager()
    {
        return $this->em;
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
        return $this;
    }

    public function getUserRepository()
    {
    	$class = ZfcUser::getOption('user_model_class');
        return $this->getEntityManager()->getRepository($class);
    }
}

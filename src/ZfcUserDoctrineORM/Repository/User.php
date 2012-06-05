<?php

namespace ZfcUserDoctrineORM\Repository;

use ZfcBase\Repository\DoctrineRepositoryProxy;
use ZfcUser\Repository\UserInterface;

class User extends DoctrineRepositoryProxy implements UserInterface
{
    /**
     * find by email
     *
     * @param string $email
     * @return \ZfcUser\Model\UserInterface|null
     */
    public function findByEmail($email)
    {
        $em = $this->getObjectManager();
        $user = $this->getDoctrineRepository()->findOneBy(array('email' => $email));
        $this->events()->trigger(__FUNCTION__, $this, array('user' => $user, 'em' => $em));
        return $user;
    }

    /**
     * find by username
     *
     * @param string $username
     * @return \ZfcUser\Model\UserInterface|null
     */
    public function findByUsername($username)
    {
        $em = $this->getObjectManager();
        $user = $this->getDoctrineRepository()->findOneBy(array('username' => $username));
        $this->events()->trigger(__FUNCTION__, $this, array('user' => $user, 'em' => $em));
        return $user;
    }

}
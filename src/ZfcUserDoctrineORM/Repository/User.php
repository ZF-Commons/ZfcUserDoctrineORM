<?php

namespace ZfcUserDoctrineORM\Repository;

use ZfcUser\Module as ZfcUser;
use ZfcUser\Repository\User as ZfcUserRepository;

class User extends ZfCUserRepository
{
    public function findByEmail($email)
    {
        $class = ZfcUser::getOption('user_model_class');
        return $this->getMapper()->em()->getRepository($class)->findOneBy(array(
            'email' => $email
        ));
        $this->events()->trigger(__FUNCTION__ . '.post', $this, array('user' => $user));
        return $user;
    }
}
